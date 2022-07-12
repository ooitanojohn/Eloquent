 {{-- laravel-station 継承 --}}
 @extends('layouts.app')
 {{-- @extends('layouts.pagination.paginator') --}}
 {{-- {{ dump(session('error')) }} --}}
 @section('content')
   <h2>座席予約</h2>
   <form method="POST" action="/reservations/store">
     @csrf
     <ul>
       @if (session('error'))
         <li>{{ session('error') }}</li>
       @endif (session('error') !== null)
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
     </ul>
     <div class="mb-3">
       <label class="form-label" for="movie-id">作品ID{{ $movie_id }}</label>
       <input class="form-control" type="hidden" id="movie-id" name="movie_id"
         value="{{ old('movie_id') === null ? $movie_id : old('movie_id') }}">
     </div>
     <div class="mb-3">
       <label class="form-label" for="schedule-id">上映スケジュールID{{ $schedule_id }}</label>
       <input class="form-control" type="hidden" id="schedule-id" name="schedule_id"
         value="{{ old('schedule_id') === null ? $schedule_id : old('schedule_id') }}">
     </div>
     <div class="mb-3">
       <label class="form-label" for="sheet-id">座席{{ $sheet_id }}</label>
       <input class="form-control" type="hidden" id="sheet-id" name="sheet_id"
         value="{{ old('sheet_id') === null ? $sheet_id : old('sheet_id') }}">
     </div>
     <div class="mb-3">
       <label class="form-label" for="date">日付{{ $date }}</label>
       <input class="form-control" type="hidden" id="date" name="date"
         value="{{ old('date') === null ? $date : old('date') }}">
     </div>
     <div class="mb-3">
       <label class="form-label" for="name">予約者氏名</label>
       <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}">
     </div>
     <div class="mb-3">
       <label class="form-label" for="email">メールアドレス</label>
       <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
     </div>
     <button type="submit" class="btn btn-success">予約する</button>
   </form>
   <a href="/movies/{{ $movie_id }}" class="btn btn-primary">座席一覧へ戻る</a>
   <a href="/movies/{{ $movie_id }}" class="btn btn-primary">映画情報へ戻る</a>
 @endsection
