<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;

use App\Models\Sheet;
use App\Models\Movie;
// use App\Http\Controllers\SheetController;
// phpinfo
Route::get('info', function () {
  return phpinfo();
});

/**
 * admin 映画管理画面
 *  */
//********************* 一覧表示 index **************************
Route::get('admin/movies',[MovieController::class, 'index']);
// Route::post('admin/movies',[MovieController::class,'index']);

//********************* 登録 create store**************************
// get 200 フォーム表示
Route::get('admin/movies/create',[MovieController::class, 'create']);
// post db保存
Route::post('admin/movies/store',[MovieController::class,'store']);

//********************* 編集 edit update**************************
Route::get('admin/movies/{id}/edit',[MovieController::class,'edit']);
Route::patch('admin/movies/{id}/update',[MovieController::class,'update']);

//********************* 物理削除 destroy**************************
Route::delete('admin/movies/{id}/destroy',[MovieController::class,'destroy']);

//********************* 詳細表示 show**************************
Route::get('/admin/movies/{id}',[MovieController::class,'show']);
/**
 * admin スケジュール管理画面
 */
//********************* スケジュール一覧表示 index **************************
Route::get('/admin/schedules',[ScheduleController::class,'index']);
//********************* スケジュール詳細表示show **************************
Route::get('/admin/schedules/{id}',[ScheduleController::class,'show']);
//********************* スケジュール新規作成 create **************************
Route::get('/admin/movies/{id}/schedules/create',[ScheduleController::class,'create']);
// 登録処理 store
Route::post('admin/movies/{id}/schedules/store',[ScheduleController::class,'store']);
//********************* スケジュール変更 edit **************************
Route::get('/admin/schedules/{scheduleId}/edit',[ScheduleController::class,'edit']);
// 更新処理 update
Route::patch('/admin/schedules/{id}/update',[ScheduleController::class,'update']);
// 削除処理 delete
Route::delete('/admin/schedules/{id}/destroy',[ScheduleController::class,'destroy']);

/**
 * admin 予約管理画面
 */
// 予約一覧
Route::get('/admin/reservations/',[AdminReservationController::class,'index']);
// 予約追加フォーム表示
Route::get('/admin/reservations/create',[AdminReservationController::class,'create']);
// 予約追加実行
Route::post('/admin/reservations/',[AdminReservationController::class,'store']);
// 予約詳細・編集フォーム表示
Route::get('/admin/reservations/{id}',[AdminReservationController::class,'edit']);
// 予約編集実行
Route::put('/admin/reservations/{id}',[AdminReservationController::class,'update']);
// 予約削除実行
Route::delete('/admin/reservations/{id}/destroy',[AdminReservationController::class,'destroy']);

/**
 * User
 */
//********************* 座席表 一覧 **************************
// Route::get('/sheets',[ReservationController::class,'index']);
// show
Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets',[ReservationController::class,'index']);
// create
Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create',[ReservationController::class,'create']);
// post
Route::post('reservations/store',[ReservationController::class,'store']);

//********************* 上映スケジュール**************************
Route::get('/movies/{id}',function($id){
    return view('movie',['movie'=>Movie::find($id),'schedules'=>Movie::find($id)->schedules]);
});
