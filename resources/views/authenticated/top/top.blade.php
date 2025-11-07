<x-sidebar>
<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <p>マイページ</p>
    <div class="user_status p-3">
      <!-- ログインしていない人を認証、はじくエラーを回避 -->
      @auth
        <p>名前：<span>{{ Auth::user()->over_name }}</span><span class="ml-1">{{ Auth::user()->under_name }}</span></p>
        <p>カナ：<span>{{ Auth::user()->over_name_kana }}</span><span class="ml-1">{{ Auth::user()->under_name_kana }}</span></p>
        <p>性別：@if(Auth::user()->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
        <p>生年月日：<span>{{ Auth::user()->birth_day }}</span></p>
      @endauth
    </div>
    <!-- ログインしていない状態でtopページに移動しようした場合の処理 -->
     @if (!empty($timeoutError))
      <div style="color: red; text-align: center; margin-top: 20px;">
        {{ $timeoutError }}
      </div>
    <!-- 3秒後にログインページへ移動 -->
      <script>
            setTimeout(function(){
                window.location.href = "{{ route('loginView') }}";
            }, 3000);
      </script>
    @endif
  </div>
</div>
</x-sidebar>
