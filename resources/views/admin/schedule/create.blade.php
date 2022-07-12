 {{-- laravel-station 継承 --}}
 @extends('layouts.app')
 {{-- @extends('layouts.pagination.paginator') --}}
 @section('content')
   <h2>スケジュール追加</h2>
   <form method="POST" action="store">
     @csrf
     @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
     @endforeach
     <div class="row">
       <div class="col">
         <label class="form-label" for="movie-id">作品ID{{ $id }}</label>
         <input class="form-control" type="hidden" id="movie-id" name="movie_id"
           value="{{ old('movie_id') === null ? $id : old('movie_id') }}">
       </div>
       <div class="col"><label class="form-label" for="start-time-date">開始日付</label>
         <input class="form-control" type="date" id="start-time-date" name="start_time_date"
           value="{{ old('start_time_date') }}">
       </div>
       <div class="col"><label class="form-label" for="end-time-date">終了日付</label>
         <input class="form-control" type="date" id="end-time-date" name="end_time_date"
           value="{{ old('end_time_date') }}">
       </div>
       <div class="col"><label class="form-label" for="start-time-time">開始時刻</label>
         <input class="form-control" type="time" id="start-time-time" name="start_time_time"
           value="{{ old('start_time_time') }}">
       </div>
       <div class="col"><label class="form-label" for="end-time-time">終了時刻</label>
         <input class="form-control" type="time" id="end-time-time" name="end_time_time"
           value="{{ old('end_time_time') }}">
       </div>
     </div>

     <button type="submit" class="btn btn-success">登録</button>
   </form>
   <a href="/admin/schedules" class="btn btn-primary">スケジュール一覧へ戻る</a>
 @endsection
