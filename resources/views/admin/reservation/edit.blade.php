 {{-- laravel-station 継承 --}}
 @extends('layouts.app')
 {{-- @extends('layouts.pagination.paginator') --}}
 @section('content')
   {{-- {{ dump($reservate) }} --}}
   {{-- {{ dump($movie) }} --}}
   <form method="POST" action="/admin/reservations/{{ $reservate->id }}">
     {{-- patchメソッド埋め込み --}}
     @method('PUT')
     @csrf
     @foreach ($errors->all() as $error)
       <li class="mb-3">{{ $error }}</li>
     @endforeach
     <div class="row">
       <div class="mb-3">
         <label class="form-label" for="schedule-id">上映スケジュールID{{ $reservate->schedule_id }}</label>
         <input class="form-control" type="hidden" id="schedule-id" name="schedule_id"
           value="{{ old('schedule_id') === null ? $reservate->schedule_id : old('schedule_id') }}">
       </div>
       <div class="mb-3">
         <label class="form-label" for="movie-id">映画ID{{ $movie->id }} 作品タイトル{{ $movie->title }}</label>
         <input class="form-control" type="hidden" id="movie-id" name="movie_id"
           value="{{ old('movie_id') === null ? $movie->id : old('movie_id') }}">
       </div>
       <div class="mb-3">
         <label class="form-label" for="sheet-id">座席{{ $reservate->sheet_id }}</label>
         <input class="form-control" type="text" id="sheet-id" name="sheet_id"
           value="{{ old('sheet_id') === null ? $reservate->sheet_id : old('sheet_id') }}">
       </div>
       <div class="mb-3">
         <label class="form-label" for="date">上映日時{{ $reservate->date }}</label>
         <input class="form-control" type="text" id="date" name="date"
           value="{{ old('date') === null ? $reservate->date : old('date') }}">
       </div>
       <div class="mb-3">
         <label class="form-label" for="name">予約者氏名</label>
         <input class="form-control" type="text" id="name" name="name"
           value="{{ old('name') === null ? $reservate->name : old('name') }}">
       </div>
       <div class="mb-3">
         <label class="form-label" for="email">メールアドレス</label>
         <input class="form-control" type="email" id="email" name="email"
           value="{{ old('email') === null ? $reservate->email : old('email') }}">
       </div>
       <button type="submit" class="btn btn-success">変更する</button>
     </div>
   </form>
   <button type="button" class="btn btn-danger" data-coreui-toggle="modal" data-coreui-target="#Modal-delete"
     data-coreui-whatever="{{ $reservate->id }}" value="/admin/reservations/">削除</button>
   <div class="modal fade" id="Modal-delete" tabindex="-1" aria-labelledby="Modal-deleteLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <p class="modal-title" id="Modal-deleteLabel">本当に削除しますか？</p>
           <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-footer">
           <form action="" method='post'>
             @method('DELETE')
             @csrf
             <input type="submit" name="delete" value="削除" class="btn btn-danger">
           </form>
           <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
   </div>
   <a href="/admin/reservations/" class="btn btn-info">予約管理一覧へ戻る</a>
 @endsection
