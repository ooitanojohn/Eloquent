{{-- laravel-station 継承 --}}
@extends('layouts.app')

@section('content')
  {{-- {{ dump($movie) }}
  {{ dump($schedules) }} --}}
  @if (session('reservation'))
    <li>{{ session('reservation') }}</li>
  @endif (session('error') !== null)
  <div class="card text-center">
    <div class="card-header">
      映画情報
    </div>
    <img src="{{ $movie->image_url }}" class="card-img-top" alt="{{ $movie->title }}画像" height="300px">
    <div class="card-body">
      <h5 class="card-title">タイトル{{ $movie->title }}</h5>
      <p class="card-text">公開日{{ $movie->published_year }}</p>
      <p class="card-text">説明{{ $movie->description }}</p>
      <a href="" class="btn btn-primary">映画詳細</a>
    </div>
  </div>
  <div class="row">
    @foreach ($schedules as $schedule)
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $schedule->start_time->format('Y-m-d') }}</h5>
            <h5 class="card-title">{{ $schedule->start_time->format('H:i') }} ~
              {{ $schedule->end_time->format('H:i') }}</h5>
            <a href="/movies/{{ $movie->id }}/schedules/{{ $schedule->id }}/sheets?date={{ $schedule->start_time->format('Y-m-d') }}"
              class="btn btn-primary">予約</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
