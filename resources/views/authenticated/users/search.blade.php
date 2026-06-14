<x-sidebar>
<div class="search_content w-100 border d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person" style="box-shadow:0 0 8px #808080;">
      <div>
        <span style="color: #808080;
    font-weight: bold;">ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span style="color: #808080;
    font-weight: bold;">名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span style="color: #808080;
    font-weight: bold;">カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span style="color: #808080;
    font-weight: bold;">性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span style="color: #808080;
    font-weight: bold;">性別 : </span><span>女</span>
        @elseif($user->sex == 3)
        <span style="color: #808080;
    font-weight: bold;">性別 : </span><span>その他</span>
        @endif
      </div>
      <div>
        <span style="color: #808080;
    font-weight: bold;">生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span style="color: #808080;
    font-weight: bold;">役職 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span style="color: #808080;
    font-weight: bold;">役職 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span style="color: #808080;
    font-weight: bold;">役職 : </span><span>講師(英語)</span>
        @else
        <span style="color: #808080;
    font-weight: bold;">役職 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        <!-- 一覧で生徒(4)のみ選択科目表示。教師(1.2.3)は非表示にする 46行目～51行目まで -->
        @if($user->role == 4)
          <span style="color: #808080;">
          選択科目 : 
          <!-- 選択科目の表示はprofileブレードの11行目～13行目を参考 -->
          @foreach($user->subjects as $subject)
          </span><span>{{ $subject->subject }}</span>
          @endforeach
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 border">
    <div class="search-box">
      <div class="search-box1"><p style="margin-bottom:5%; font-size:20px; color: #606060;">検索</p>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div class="search-box2"style="margin-top:5%;">
        <lavel style="color: #606060;">カテゴリ</lavel>
          <p style="margin-top:5%;">
            <select form="userSearchRequest" name="category">
              <option value="name">名前</option>
              <option value="id">社員ID</option>
            </select>
          </p>
      </div>
      <div class="search-box3">
        <label style="color: #606060;">並び替え</label>
          <p>
            <select name="updown" form="userSearchRequest">
              <option value="ASC">昇順</option>
              <option value="DESC">降順</option>
            </select>
          </p>
      </div>
      <div class="search-box4">
        <p class="m-0 search_conditions"><span>検索条件の追加</span></p>
        <div class="search_conditions_inner">
          <div class="search_conditions_inner1">
            <label style="color: #606060;">性別</label>
              <p class="search_conditions_box">
                <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
                <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
                <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
              </p>
          </div>
        <div class="search_conditions_inner2">
            <label style="color: #606060;">権限</label>
              <p>
                <select name="role" form="userSearchRequest" class="engineer">
                  <option selected disabled>----</option>
                  <option value="1">教師(国語)</option>
                  <option value="2">教師(数学)</option>
                  <option value="3">教師(英語)</option>
                  <option value="4" class="">生徒</option>
                </select>
              </p>
          </div>
          <div class="selected_engineer search_conditions_inner3">
            <label style="color: #606060;">選択科目</label>
            <!-- 新規ユーザー登録の記述を参考(registerブレードの177～182行目の記述参考) -->
             <div class="subjects-box">
                @foreach($subjects as $subject)
                <!-- 93行目　$subjectに入っている科目一覧を一件ずつ取り出して$Subjectという変数名で使えるようにする。科目の数だけ記述内に表示させる -->
                  <div class="search_subject">
                    <label>{{ $subject->subject }}</label>
                    <!-- 画面に表示する文字。選択科目の名前が表示される -->
                    <input type="checkbox" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest">
                <!-- タイプはチックボックス。 name="subject[]"value="{{ $subject->id }} はチェックした項目の配列としておくられる。国語と英語ならSubject＝[1，3]のようになる-->
                  </div>
                @endforeach
              </div>
          </div>
      </div>
      </div>
      <div class="search_btn_style">
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest">
        </div>
        <div class="reset_btn_style">
          <input type="reset" value="リセット" form="userSearchRequest">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
</x-sidebar>
