<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Sheet;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Movie;

use Validator;

class AdminReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 公開予定の映画スケジュール一覧
        $schedules = Schedule::where('start_time','>=',date("Y-m-d h:i:s"))->orderBy('start_time','asc')->with('reservations')->get();
        // dump($schedules[0]);
        // dump($schedules[0]->movie->title);
        // dump($schedules[0]['reservations']);
        return view('admin.reservation.index',[
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reservation.create',['schedules' => Schedule::where('start_time','>=',date("Y-m-d h:i:s"))->orderBy('start_time','asc')->get(),
    'sheets' => Sheet::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // 複合ユニークバリデーション
        $unique = Reservation::where([
            ['date','=',$request->date],
            ['schedule_id','=',$request->schedule_id],
            ['sheet_id','=',$request->sheet_id]])->get();
            // dd(isset($unique[0]->id));
            if(isset($unique[0]->id) === true){
                // dd('error');
                return redirect("/admin/reservations/")->with('status','その座席は既に予約済みです');
            }
         // バリデートルール movie_id ??
        $rules = [
            'schedule_id' => 'required|numeric',
            'sheet_id' => 'required|numeric',
            'date' => 'required|date',
            'name' => 'required|string:50',
            'email' => 'required|email:rfc,strict,filter|string:255',
        ];
        // varidate::make('値の配列','検証ルールの配列')
        $validator = Validator::make($request->all(),$rules);
        // dd($validator);
        // validator->fails エラー発生時
        if($validator->fails()){
            return redirect("/admin/reservations/")
            ->withErrors($validator)
            ->withInput();
        }
        // DB登録
        Reservation::create($request->all());
        return redirect("/admin/reservations/",302)->with('reservation','予約が完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservate = Reservation::find($id);
        return view('admin.reservation.edit',['reservate'=> $reservate,
    'movie' => Movie::find($reservate->schedule->movie_id)]);
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
        // dd($request);
        // request値すべてあって200
        // if($request->date === null || $request->sheetId === null || $request->sheetId === null|| $request->sheetId === null|| $request->sheetId === null){
        //     return \App::abort(404);
        // }
         // バリデートルール movie_id ??
        $rules = [
            'schedule_id' => 'required|numeric',
            'sheet_id' => 'required|numeric|exists:sheets,id',
            'date' => 'required|date_format:Y-m-d',
            'name' => 'required|string:50',
            'email' => 'required|email:rfc,strict,filter|string:255',
        ];
        // varidate::make('値の配列','検証ルールの配列')
        $validator = Validator::make($request->all(),$rules);
        // validator->fails エラー発生時
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        // DB登録
        $reservate = Reservation::find($id);

        if($reservate->date === $request->date && $reservate->schedule_id === (int)$request->schedule_id && $reservate->sheet_id === (int)$request->sheet_id){
        }else{
            $unique = Reservation::where([
            ['date','=',$request->date],
            ['schedule_id','=',$request->schedule_id],
            ['sheet_id','=',$request->sheet_id]])->get();
            if(isset($unique[0]->id) === true){
                return \App::abort(404);
            }
        }
        $reservate->fill([
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'date' => $request->date,
            'name' => $request->name,
            'email' => $request->email,
        ])->save();
        return redirect("/admin/reservations/",302)->with('reservation','予約を変更しました');
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
        if(Reservation::find($id) === null){
            return \App::abort(404);
        }
        // title返す為変数に代入
        $Reservation = Reservation::find($id);
        $Reservation->delete();
        return redirect('admin/reservations',302)->with('status','スケジュールID'.$Reservation->id. 'は削除されました');
    }
}
