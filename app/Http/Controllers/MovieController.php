<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Varidatorをuse
use Validator;
// Movieコントローラをimport
use App\Models\Movie;
// about(404) メソッド
// use Illuminate\Foundation\Application;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全件表示
        if($_GET === []){
            return view('/admin/movie/index',['movies' => Movie::all()]);
        }
        // 検索空
        if($_GET['keyword'] === ''){
            // すべて
            if($_GET['is_showing'] === ''){
            return view('/admin/movie/index',['movies' => Movie::all()]);
            }
            // 公開予定
            if($_GET['is_showing'] === '0'){
            // dump(Movie::where('is_showing',0)->get());
            return view('/admin/movie/index',['movies' => Movie::where('is_showing',0)->get()]);
            }
            // 公開中
            if($_GET['is_showing'] === '1'){
            return view('/admin/movie/index',['movies' => Movie::where('is_showing',1)->get()]);
            }
        }
        // 検索文字あり
        if($_GET['keyword'] !== ''){
            // all
            if($_GET['is_showing'] === ''){
                return view('/admin/movie/index',['movies' => Movie::where('title','LIKE','%'.$_GET['keyword'].'%')->get()]);
            }
            // 公開予定 || 公開中
            return view('/admin/movie/index',['movies' => Movie::where('title','LIKE','%'.$_GET['keyword'].'%')->where('is_showing',$_GET['is_showing'])->get()]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin/movie/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデートルール
        $rules = [
            'title' => 'bail|required|max:255|unique:App\Models\Movie,title',
            'published_year' => 'required|date',
            'description' => 'required',
            'image_url' => 'required|url'];
        // varidate::make('値の配列','検証ルールの配列')
        $validator = Validator::make($request->all(),$rules);
        // validator->fails エラー発生時
        if($validator->fails()){
            return redirect('/admin/movies/create')
            ->withErrors($validator)
            ->withInput();
        }
        // DB登録
        $movie = new Movie;
        $movie->fill($request->all())->save();
        // Movie::create($request->all()); 新規作成
        return redirect('admin/movies',302);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('/admin/movie/movie',['movie'  => Movie::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('/admin/movie/edit',['movies' => Movie::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // バリデートルール
        $rules = [
            'title' => 'bail|required|max:255|unique:App\Models\Movie,title,'.$request->id.',id',
            'published_year' => 'required|date',
            'description' => 'required',
            'image_url' => 'required|url'];
        // varidate::make('値の配列','検証ルールの配列')
        $validator = Validator::make($request->all(),$rules);
        // validator->fails エラー発生時
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $movie = Movie::find($id);
        $movie->fill($request->all())->save();
        return redirect('admin/movies',302);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // レコードがnull = 404返す
        if(Movie::find($id) === null){
            return \App::abort(404);
        }
        // title返す為変数に代入
        $movie = Movie::find($id);
        $movie->delete();
        return redirect('admin/movies',302)->with('status',$movie->title. 'は削除されました');
    }
}
