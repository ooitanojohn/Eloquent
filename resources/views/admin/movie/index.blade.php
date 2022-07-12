{{-- laravel-station 継承 --}}
@extends('layouts.app')
{{-- @extends('layouts.pagination.paginator') --}}
@if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
@endif
{{-- {{ dump(request()->get('is_showing')) }} --}}
@section('content')
  <form method="GET" class="mb-5">
    <div class="row">
      <div class="col">
        <input type="text" class="form-control" placeholder="タイトルを入力してください" aria-label="タイトルを入力してください" name="keyword">
      </div>
      <div class="col">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="is_showing" id="inlineRadio1" value=""
            {{ request()->get('is_showing') == null ? 'checked' : '' }}> <label class="form-check-label"
            for="inlineRadio1">すべて</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="is_showing" id="inlineRadio2" value="0"
            {{ request()->get('is_showing') == '0' ? 'checked' : '' }}>
          <label class="form-check-label" for="inlineRadio2">公開予定</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="is_showing" id="inlineRadio3" value="1"
            {{ request()->get('is_showing') == '1' ? 'checked' : '' }}>
          <label class="form-check-label" for="inlineRadio3">公開中</label>
        </div>
      </div>
      <div class="col">
        <button type="submit" class="btn btn-primary">映画検索</button>
      </div>
      <div class="col">
        <a href="/admin/movies/create" class="btn btn-primary">映画新規登録</a>
      </div>
      <div class="col">
        <a href="/admin/schedules" class="btn btn-primary">スケジュール一覧</a>
      </div>
    </div>
  </form>

  <table class="table">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">映画タイトル</th>
      <th scope="col">公開年</th>
      <th scope="col">上映中かどうか</th>
      <th scope="col">概要</th>
      <th scope="col">画像URL</th>
      <th scope="col">登録日時</th>
      <th scope="col">更新日時</th>
    </tr>
    @foreach ($movies as $movie)
      <tr>
        <th>{{ $movie->id }}</th>
        <td>{{ $movie->title }}</td>
        <td>{{ $movie->published_year }}</td>
        <td>{{ $movie->is_showing === 1 ? '公開中' : '公開予定' }} </td>
        <td>{{ $movie->description }}</td>
        <td><img alt="{{ $movie->image_url }}" src="{{ $movie->image_url }}" width="100" height="100"></td>
        <td>{{ $movie->created_at }}</td>
        <td>{{ $movie->updated_at }}</td>
        <td><a href="/admin/movies/{{ $movie->id }}" class="btn btn-primary">詳細</a></td>
        <td><a href="/admin/movies/{{ $movie->id }}/edit" class="btn btn-primary">編集</a></td>
        <td>
          <button type="button" class="btn btn-danger" data-coreui-toggle="modal" data-coreui-target="#Modal-delete"
            data-coreui-whatever="{{ $movie->id }}" value="/admin/movies/">削除</button>
          <div class="modal fade" id="Modal-delete" tabindex="-1" aria-labelledby="Modal-deleteLabel"
            aria-hidden="true">
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
        </td>
      </tr>
    @endforeach
  </table>
@endsection
