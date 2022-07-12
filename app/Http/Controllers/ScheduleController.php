<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Varidatorをuse
use Validator;
use App\Models\Movie;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $movies = Movie::all();
        // foreach($movies as $movie){
        //     $schedules[] = $movie->schedules;
        // }
        // dd($schedules,$movies);
        return view('/admin/schedule/index',['movies'=> Movie::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('/admin/schedule/create',['id' => $id]);
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
            'movie_id' => 'bail|exists:App\Models\Movie,id',
            'start_time_date' => 'required|date_format:Y-m-d',
            'end_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_time' => 'required|date_format:H:i'];
        // varidate::make('値の配列','検証ルールの配列')
        $validator = Validator::make($request->all(),$rules);
        // validator->fails エラー発生時
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        // ("/admin/movies/$request->movie_id/schedules/create")
        // DB登録
        $schedule = new Schedule;
        $schedule->fill([
        'movie_id' => $request->movie_id,
        'start_time' => $request->start_time_date .' '. $request->start_time_time,
        'end_time' => $request->end_time_date.' '.$request->end_time_time
        ])->save();
        // schedule::create($request->all()); 新規作成
        return redirect('admin/schedules',302);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('/admin/schedule/schedule',['schedule'=> Schedule::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($scheduleId)
    {
        return view('/admin/schedule/edit',['schedule'=> Schedule::find($scheduleId)]);
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
            'start_time_date' => 'required|date_format:Y-m-d',
            'end_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_time' => 'required|date_format:H:i'];
        // varidate::make('値の配列','検証ルールの配列')
        $validator = Validator::make($request->all(),$rules);
        // validator->fails エラー発生時
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        // ("/admin/schedules/$request->id/edit")
        // DB登録
        $schedule = Schedule::find($id);
        $schedule->fill([
        'start_time' => $request->start_time_date .' '. $request->start_time_time,
        'end_time' => $request->end_time_date.' '.$request->end_time_time
        ])->save();
        // schedule::create($request->all()); 新規作成
        return redirect('admin/schedules',302);
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
        if(Schedule::find($id) === null){
            return \App::abort(404);
        }
        // title返す為変数に代入
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect('admin/schedules',302)->with('status','スケジュールID'.$schedule->id. 'は削除されました');
    }
}
