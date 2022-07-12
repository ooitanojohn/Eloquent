 {{-- laravel-station 継承 --}}
 @extends('layouts.app')
 {{-- @extends('layouts.pagination.paginator') --}}
 @section('content')
   {{-- {{ dump($movies) }} --}}
   <form method="POST" action="/admin/movies/{{ $movies->id }}/update">
     {{-- patchメソッド埋め込み --}}
     @method('PATCH')
     @csrf
     @foreach ($errors->all() as $error)
       <li class="mb-3">{{ $error }}</li>
     @endforeach
     <div class="mb-3">
       <label class="form-label" for="title">映画タイトル</label>
       <input type="text" id="title" name="title" value="{{ $movies->title }}">
     </div>
     <div class="mb-3">
       <label class="form-label" for="published-year">公開年</label>
       <input class="form-control" type="date" id="published-year" name="published_year"
         value="{{ $movies->published_year }}">
     </div>
     <div class="form-check">
       <input type="hidden" id="is-showing" name="is_showing" value="0">
       <input class="form-check-input" type="checkbox" id="is-showing" name="is_showing" value="1"
         {{ $movies->is_showing == 1 ? 'checked' : '' }}>
       <label class="form-check-label" for="is-showing">公開中かどうか</label>
     </div>
     <div class="form-floating">
       <label class="form-label" for="description">概要</label>
       <textarea class="form-controll" id="description" rows="5" cols="100"
         name="description">{{ $movies->description }}</textarea>
     </div>
     <div class="mb-3">
       <label class="form-label" for="image_url">画像URL</label>
       <input class="form-control" type="url" id="image_url" name="image_url" value="{{ $movies->image_url }}">
     </div>
     <button type="submit" class="btn btn-primary">登録</button>
   </form>
   <a href="/admin/movies" class="btn btn-primary">映画一覧へ戻る</a>
 @endsection
