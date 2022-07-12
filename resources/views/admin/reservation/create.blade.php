 {{-- laravel-station 継承 --}}
 @extends('layouts.app')
 {{-- @extends('layouts.pagination.paginator') --}}
 {{-- {{ dump(session('error')) }} --}}
 @section('content')
   <h2>座席予約</h2>
   <form method="POST" action="/admin/reservations/">
     @csrf
     {{-- {{ dump($schedules) }} --}}
     <div class="mb-3">
       <label class="form-label" for="schedule-id">上映スケジュールID</label>
       <select class="form-select" aria-label="Default select example" id="schedule-id" name="schedule_id">
         <option selected>映画タイトルからスケジュールIDを選択してください</option>
         @foreach ($schedules as $schedule)
           <option value="{{ $schedule->id }}">スケジュールID:{{ $schedule->id }} 映画タイトル:{{ $schedule->movie->title }}
             上映日時:{{ $schedule->start_time->format('Y-m-d H:i') }} ~
             {{ $schedule->end_time->format('Y-m-d H:i') }}
           </option>
         @endforeach
       </select>
     </div>
     <div class="mb-3">
       {{-- 上の選択肢で座席絞り込みたい --}}
       <label class="form-label" for="sheet-id">座席</label>
       <select class="form-select" aria-label="Default select example" id="sheet-id" name="sheet_id">
         <option selected>座席番号を選択してください</option>
         @foreach ($sheets as $sheet)
           <option value="{{ $sheet->id }}">座席番号:{{ $sheet->id }} column:{{ $sheet->column }}
             row:{{ $sheet->row }}
           </option>
         @endforeach
       </select>
     </div>
     <div class="mb-3">
       <label class="form-label" for="date">日時?</label>
       <input class="form-control" type="date" id="date" name="date" value="">
     </div>
     <div class="mb-3">
       <label class="form-label" for="name">予約者氏名</label>
       <input class="form-control" type="text" id="name" name="name" value="">
     </div>
     <div class="mb-3">
       <label class="form-label" for="email">メールアドレス</label>
       <input class="form-control" type="email" id="email" name="email" value="">
     </div>
     <button type="submit" class="btn btn-success">予約する</button>
   </form>
   <a href="/admin/reservations/" class="btn btn-info">予約管理一覧へ戻る</a>
 @endsection
