{{-- laravel-station 継承 --}}
@extends('layouts.app')
@if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
@endif
@section('content')
  {{-- {{ dump($movies) }} --}}
  <a href="/admin/movies" class="btn btn-primary">映画一覧へ</a>
  @foreach ($movies as $movie)
    {{-- {{ dump($movie->schedules) }} --}}
    <div class="row mb-3">
      <div class="d-flex p-3">
        <h2 class="me-3">{{ $movie->id }},{{ $movie->title }}</h2>
        <a href="/admin/movies/{{ $movie->id }}/schedules/create" class="btn btn-primary">新規上映時間追加</a>
      </div>
      @foreach ($movie->schedules as $schedule)
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $schedule->start_time->format('H:i') }} ~
                {{ $schedule->end_time->format('H:i') }}</h5>
              <p class="card-text">
                id{{ $schedule->id }}登録日時{{ $schedule->created_at }}更新日時{{ $schedule->updated_at }}</p>
              <a href="/admin/schedules/{{ $schedule->id }}" class="btn btn-primary">スケジュール詳細</a>
              <a href="/admin/schedules/{{ $schedule->id }}/edit" class="btn btn-primary">編集</a>
              <button type="button" class="btn btn-danger" data-coreui-toggle="modal" data-coreui-target="#Modal-delete"
                data-coreui-whatever="{{ $schedule->id }}" value="/admin/schedules/">削除</button>
              <div class="modal fade" id="Modal-delete" tabindex="-1" aria-labelledby="Modal-deleteLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <p class="modal-title" id="Modal-deleteLabel">本当に削除しますか？</p>
                      <button type="button" class="btn-close" data-coreui-dismiss="modal"
                        aria-label="Close"></button>
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
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach
@endsection
