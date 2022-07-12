 {{-- laravel-station 継承 --}}
 @extends('layouts.app')
 {{-- @extends('layouts.pagination.paginator') --}}
 @section('content')
   <form method="post" action="store">
     @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
     @endforeach
     @csrf
     <div class="mb-3">
       <label class="form-label" for="title">映画タイトル</label>
       <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}">
     </div>
     <div class="mb-3"><label class="form-label" for="published-year">公開年</label>
       <input class="form-control" type="date" id="published-year" name="published_year"
         value="{{ old('published_year') }}">
     </div>
     <div class="mb-3">
       <label class="form-label" for="is-showing">公開中かどうか</label>
       <input class="form-control" type="hidden" id="is-showing" name="is_showing" value="0"> <input
         class="form-control" type="checkbox" id="is-showing" name="is_showing" value="1"
         {{ old('is_showing') == 1 ? 'checked' : '' }}>
     </div>
     <div class="mb-3"> <label class="form-label" for="description">概要</label>
       <textarea class="form-controll" id="description" rows="5" cols="33"
         name="description">{{ old('description') }}</textarea>
     </div>
     <div class="mb-3">
       <label class="form-label" for="image_url">画像URL</label>
       <input class="form-control" type="url" id="image_url" name="image_url" value="{{ old('image_url') }}">
     </div>

     <button type="submit" class="btn btn-success">登録</button>
   </form>
   <a href="/admin/movies" class="btn btn-primary">映画一覧へ戻る</a>
 @endsection
