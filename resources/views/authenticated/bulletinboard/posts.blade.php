<x-sidebar>
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      @foreach($post->subCategories as $sub_category)
        <p><span class="sub_category_name">{{ $sub_category->sub_category }}</span></p>
      @endforeach
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="comment_Counts">{{ $post->postComments->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likeCount() }}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likeCount() }}</span></p>
            @endif
          </div>
          <!-- 16行目、18行目いいね機能の処理を動かす為にspanの中に{{ $post->id }}と{{ $post->likeCount() }}を一緒に記述を書く。-->
          <!-- 一緒に書くことでbulletin.jsの23行目の記述が処理される。いいねと人数のカウントが同時に変化する。 -->
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class=""><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="">
        <input type="text" placeholder="キーワードを検索" name="keyword" name="sub_category" form="postSearchRequest">
        <input type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
      <ul>
        <!-- 登録されているメインカテゴリー -->
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}<span></li>
        <!-- 登録されているサブカテゴリー -->
         <!-- サブカテゴリーのボタンを押すとサブカテゴリーに属する投稿が表示される -->
          @foreach($category->subCategories as $sub)
            <li class="sub_category">
              <form action="{{ route('post.show') }}" method="get">
                <input type="hidden" name="sub_category_id" value="{{ $sub->id }}">
                <button type="submit" class="category_btn" >{{ $sub->sub_category }}</button>
              </form>
            </li>
          @endforeach
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
  <!-- JSリンク追加 -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/bulletin.js') }}"></script> -->
</div>
</x-sidebar>
