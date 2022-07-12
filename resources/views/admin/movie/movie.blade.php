{{-- laravel-station 継承 --}}
@extends('layouts.app')

@section('content')
  {{-- {{ dump($movie->schedules) }} --}}
  <h2>No{{ $movie->id }}映画詳細</h2>
  <div class="row">
    <div class="card" style="width: 18rem;">
      <img src="{{ $movie->image_url }}" class="card-img-top" alt="{{ $movie->title }}の画像">
      <div class="card-body">
        <h5 class="card-title">{{ $movie->title }}</h5>
        <p class="card-text">{{ $movie->description }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">{{ $movie->is_showing === 1 ? '公開中' : '非公開' }}</li>
        <li class="list-group-item">更新日時{{ $movie->updated_at }}</li>
        <li class="list-group-item">登録日時{{ $movie->created_at }}</li>
      </ul>
    </div>
    <div class="col">
      <a href="/admin/movies/{{ $movie->id }}/schedules/create" class="btn btn-primary">新規上映時間追加</a>
    </div>
    <div class="col">
      <a href="/admin/movies" class="btn btn-primary">映画一覧へ戻る</a>
    </div>
  </div>
  <div class="row">
    @foreach ($movie->schedules as $schedule)
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $schedule->start_time->format('H:i') }} ~
              {{ $schedule->end_time->format('H:i') }}</h5>
            <p class="card-text">id{{ $schedule->id }}</p>
            <p class="card-text">登録日時{{ $schedule->created_at }}</p>
            <p class="card-text">更新日時{{ $schedule->updated_at }}</p>
            <a href="/admin/schedules/{{ $schedule->id }}" class="btn btn-primary">スケジュール詳細</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
