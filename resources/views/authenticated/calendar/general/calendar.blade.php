<x-sidebar>
 
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
  <div class="modal calender_js-modal">
    <div class="modal__bg calender_js-modal-close"></div>
    <div class="modal__content_calender ">
      <form action="{{ route('deleteParts') }}" method="post">
         @foreach($settings as $setting)
        <div class="w-100">
          <div class="modal-inner w-50 m-auto">
            <p class="data-date">予約日：{{ $setting->date }}</p>
            <p class="data-part">時間：リモート{{ $setting->reservePart }}</p>
            <p>上記の予約をキャンセルしてもよろしいですか？</p>
          </div>
          <div class="w-50 m-auto edit-modal-btn d-flex">
            <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
            <input type="hidden" class="edit-modal-hidden_calender" name="reserve_setting_id" value="{{ $setting->id }}">
            <input type="submit" class="btn btn-primary d-block" value="キャンセル">
          </div>
        </div>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</x-sidebar>
