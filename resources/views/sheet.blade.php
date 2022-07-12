{{-- laravel-station 継承 --}}
@extends('layouts.app')
{{-- {{ dump(request('date')) }} --}}
@section('content')
  @if (session('error'))
    <li>{{ session('error') }}</li>
  @endif (session('error') !== null)
  <table class="table" style="text-align: center">
    <thead>
      <tr>
        <th scope="col">.</th>
        <th scope="col" colspan="3">スクリーン</th>
        <th scope="col">.</th>
      </tr>
      <tr>
        @for ($i = 0; $i < 5; $i++)
          <th scope="col">.</th>
        @endfor
      </tr>
    </thead>
    <tbody>
      {{-- {{ dump($reservates) }} --}}
      @foreach ($sheets as $sheet)
        {{-- {{ dump($sheet->id) }} --}}
        <?php $state = '空席'; ?>
        @if ($sheet->id % 5 === 1)
          <tr>
        @endif
        @foreach ($reservates as $reservate)
          @if ($sheet->column === $reservate->column && $sheet->row === $reservate->row)
            <td class="bg-secondary">
              <a>{{ $sheet->column }} - {{ $sheet->row }}</a>
            </td>
            <?php $state = '予約済み'; ?>
          @break
        @endif
      @endforeach
      @if ($state === '空席')
        <td>
          <a
            href="/movies/{{ $movie_id }}/schedules/{{ $schedule_id }}/reservations/create?date={{ request('date') }}&sheetId={{ $sheet->id }}">{{ $sheet->column }}
            - {{ $sheet->row }}</a>
        </td>
      @endif
      @if ($sheet->id % 5 === 0)
        </tr>
      @endif
      @endforeach
    </tbody>
  </table>
@endsection
