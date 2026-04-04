<!--  予約詳細画面のページ -->
<x-sidebar>
  <div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
    
    <div class="w-50 m-auto h-75">
      <p><span>{{ $date }}日</span><span class="ml-3">{{ $part }}部</span></p>
      <div class="h-75 border">
        <table class="">
          <tr class="text-center">
            <th class="w-25">ID</th>
            <th class="w-25">名前</th>
            <th class="w-25">場所</th>
          </tr>
          <!-- 情報を絞り出す方法　＠foreachを2回記述して必要な情報を取り出す。1つめ$reservePersonsで予約の複数のデータを$reserveに変換　ここの変数はブレードのみで使用する為何でもいい。> -->
           <!-- 2つめの＠foreachで$reserveからusersテーブルから予約した人のデータを取り出す。 -->
          @foreach($reservePersons as $reserve)
          @foreach($reserve->users as $user)
            <tr class="text-center">
              <td class="w-25">{{ $user->id }}</td>
              <td class="w-25">{{ $user->over_name}}{{$user->under_name }}</td>
              <td class="w-25">リモート</td>
            </tr>
          @endforeach
        @endforeach
        </table>
      </div>
    </div>
  </div>
</x-sidebar>
