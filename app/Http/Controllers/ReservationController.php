<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Sheet;
use App\Models\Reservation;
use App\Models\Schedule;

use Validator;

class ReservationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $movie_id
     * @param  int $schedule_id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $movie_id, $schedule_id)
    {
        if ($request->date === null) {
            return \App::abort(404);
        }
        // 予約済みの席
        $reservates = Sheet::whereHas('reservations', function (Builder $query) use ($request, $schedule_id) {
            $query->where([
                ['date', '=', $request->date],
                ['schedule_id', '=', $schedule_id],
            ]);
        })->get();
        // dump($sheet);
        // add
        $screen_id = Schedule::where('id', '=', $schedule_id)->get();
        return view('sheet', [
            'sheets' => Sheet::where('screen_id', '=', $screen_id[0]->screen_id)->get(),
            'reservates' => $reservates,
            'movie_id' => $movie_id,
            'schedule_id' => $schedule_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $movie_id, $schedule_id)
    {
        if ($request->date === null || $request->sheetId === null) {
            return \App::abort(404);
        }
        // dump($request->date,$request->sheetId,$schedule_id);
        // 既に予約
        $unique = Reservation::where([
            ['date', '=', $request->date],
            ['schedule_id', '=', $schedule_id],
            ['sheet_id', '=', $request->sheetId]
        ])->get();
        // dump(isset($unique[0]->id));
        if (isset($unique[0]->id) === true) {
            return \App::abort(404);
        }
        return view('resavation', [
            'date' => $request->date,
            'sheet_id' => $request->sheetId,
            'movie_id' => $movie_id,
            'schedule_id' => $schedule_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 複合ユニークバリデーション
        $unique = Reservation::where([
            ['date', '=', $request->date],
            ['schedule_id', '=', $request->schedule_id],
            ['sheet_id', '=', $request->sheet_id]
        ])->get();
        // dd(isset($unique[0]->id));
        if (isset($unique[0]->id) === true) {
            // dd('error');
            return redirect("/movies/$request->movie_id/schedules/$request->schedule_id/sheets?date=$request->date")->with('error', 'その座席は既に予約済みです');
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
        $validator = Validator::make($request->all(), $rules);
        // dd($validator);
        // validator->fails エラー発生時
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // DB登録
        $schedule = new Reservation;
        $schedule->fill([
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'date' => $request->date,
            'name' => $request->name,
            'email' => $request->email
        ])->save();
        // Reservation::create($request->all());
        return redirect("/movies/$request->movie_id", 302)->with('reservation', '予約が完了しました');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
