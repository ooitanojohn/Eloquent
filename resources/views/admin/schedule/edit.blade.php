 {{-- laravel-station 継承 --}}
 @extends('layouts.app')
 {{-- @extends('layouts.pagination.paginator') --}}
 @section('content')
   {{-- {{ dump($schedule) }} --}}
   <form method="POST" action="/admin/schedules/{{ $schedule->id }}/update">
     {{-- patchメソッド埋め込み --}}
     @method('PATCH')
     @csrf
     @foreach ($errors->all() as $error)
       <li class="mb-3">{{ $error }}</li>
     @endforeach
     <div class="row">
       <div class="col"><label class="form-label" for="start-time-date">開始日付</label>
         <input class="form-control" type="date" id="start-time-date" name="start_time_date"
           value="{{ old('start_time_date') === null ? $schedule->start_time->format('Y-m-d') : old('start_time_date') }}">
       </div>
       <div class="col"><label class="form-label" for="end-time-date">終了日付</label>
         <input class="form-control" type="date" id="end-time-date" name="end_time_date"
           value="{{ old('end_time_date') === null ? $schedule->end_time->format('Y-m-d') : old('end_time_date') }}">
       </div>
       <div class="col"><label class="form-label" for="start-time-time">開始時刻</label>
         <input class="form-control" type="time" id="start-time-time" name="start_time_time"
           value="{{ old('start_time_time') === null ? $schedule->start_time->format('H:i') : old('start_time_time') }}">
       </div>
       <div class="col"><label class="form-label" for="end-time-time">終了時刻</label>
         <input class="form-control" type="time" id="end-time-time" name="end_time_time"
           value="{{ old('end_time_time') === null ? $schedule->end_time->format('H:i') : old('end_time_time') }}">
       </div>
     </div>
     <button type="submit" class="btn btn-primary">変更</button>
   </form>
   <a href="/admin/schedules/{{ $schedule->id }}" class="btn btn-primary">スケジュール詳細へ戻る</a>
 @endsection
