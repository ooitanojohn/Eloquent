{{-- laravel-station 継承 --}}
@extends('layouts.app')
@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      <p>{{ session('status') }}</p>
    </div>
  @endif
  @if ($errors)
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif
  {{-- {{ dd($schedules) }} --}}
  <h2>上映予約一覧 上映順</h2>
  <a href="/admin/schedules" class="btn btn-primary">映画一覧へ</a>
  <a href="/admin/reservations/create" class="btn btn-primary">新規予約登録</a>
  @foreach ($schedules as $schedule)
    {{-- {{ dd($schedule['reservations']) }} --}}
    <div class="row mb-3">
      <a href="/admin/schedules/{{ $schedule->id }}" class="btn btn-secondary">スケジュールID:{{ $schedule->id }},詳細</a>
      <div class="d-flex p-3">
        <h5 class="me-3">映画ID:{{ $schedule->movie->id }}上映スクリーン:{{ $schedule->screen_id }}
          映画タイトル:{{ $schedule->movie->title }} 上映時間:{{ $schedule->start_time->format('Y-m-d H:i') }} ~
          {{ $schedule->end_time->format('Y-m-d H:i') }}</h5>
      </div>
      @foreach ($schedule['reservations'] as $reservate)
        {{-- {{ dump($reservate) }} --}}
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <p class="card-text">座席:{{ $reservate->sheet_id }}</p>
              <p class="card-text">名前:{{ $reservate->name }}</p>
              <p class="card-text">メルアド:{{ $reservate->email }}</p>
              <a href="/admin/reservations/{{ $reservate->id }}" class="btn btn-info">編集</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach
@endsection
