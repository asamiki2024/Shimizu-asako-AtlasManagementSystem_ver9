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
  <div class="modal calender_js-modal" id="cancelModal">
    <div class="modal__bg calender_js-modal-close"></div>
    <div class="modal__content_calender ">
      <form action="{{ route('deleteParts') }}" method="post">
         @csrf
        <div class="modal-calender  w-70 bg-white">
          <div class="modal-inner w-50 m-auto">
            <p>予約日：<spn id="modalDate"></spn></p>
            <p>時間：リモート<spn id="modalPart"></spn></p>
            <p>上記の予約をキャンセルしてもよろしいですか？</p>
          </div>
          <input type="hidden" name="reserve_setting_id" id="modalReserveSettingId">
          <div class="w-50 m-auto edit-modal-btn d-flex">
            <a class="calender_js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
            <input type="hidden" class="calender_js-modal" name="reserve_setting_id">
            <input type="submit" class="btn btn-primary d-block" value="キャンセル">
          </div>
        </div>
      
    </div>
</div>
<script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</x-sidebar>
