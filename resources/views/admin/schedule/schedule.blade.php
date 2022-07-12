{{-- laravel-station 継承 --}}
@extends('layouts.app')
{{-- {{ dump($schedule) }} --}}
@section('content')
  <div class="row mb-3">
    <h2>映画ID{{ $schedule->movie_id }}</h2>
    <p>スケジュールID{{ $schedule->id }}</p>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $schedule->start_time->format('H:i') }} ~
            {{ $schedule->end_time->format('H:i') }}</h5>
          <p class="card-text">登録日時{{ $schedule->created_at }}</p>
          <p class="card-text">更新日時{{ $schedule->updated_at }}</p>
          <a href="/admin/schedules/{{ $schedule->id }}/edit" class="btn btn-primary">編集</a>
          <button type="button" class="btn btn-danger" data-coreui-toggle="modal" data-coreui-target="#Modal-delete"
            data-coreui-whatever="{{ $schedule->id }}" value="/admin/schedules/">削除</button>
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
        </div>
      </div>
    </div>
  </div>
  <a href="/admin/schedules" class="btn btn-primary">スケジュール一覧へ戻る</a>
@endsection
