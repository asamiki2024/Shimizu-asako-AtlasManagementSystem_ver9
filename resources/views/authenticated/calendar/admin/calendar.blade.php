<x-sidebar>
<div class="w-75 m-auto">
  <div class="w-100 vh-100">
    <div class="calender-box">
      <p style="display: flex;
          justify-content: center;  margin-top: 20px;
      font-size: 15px;">{{ $calendar->getTitle() }}</p>
      <p>{!! $calendar->render() !!}</p>
    </div>
  </div>
</div>
</x-sidebar>
