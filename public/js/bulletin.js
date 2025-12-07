$(function () {
  $('.main_categories').click(function () {
    var category_id = $(this).attr('category_id');
    $('.category_num' + category_id).slideToggle();
  });
// いいね機能の処理
// いいねを付けた時に動く処理8行目～29行目まで
  $(document).on('click', '.like_btn', function (e) {
  // like_btnをクリックした時に関数が実行される。 on()が使用されていると、後から追加されたボタンにも対応できる。
    e.preventDefault();
    // aタグやbuttonのデフォルト動作を止める事が出来る。(画面遷移など)
    $(this).addClass('un_like_btn');
    // クリックされたボタンに取り消し状態のクラスを付ける。
    $(this).removeClass('like_btn');
    // 元のいいねボタンのクラスを外す。これでいいね解除になる仕組みが出来る。
    var post_id = $(this).attr('post_id');
    // クリックされた要素からpost_idの番号を取得。どの投稿に対するいいねかを判断。
    var count = $('.like_counts' + post_id).text();
    // 12行目はpostsブレードの.like_countsとpost_idが一緒に書いてある記述で動く。
    // 投稿IDに紐づいたいいねの数を取得。
    var countInt = Number(count);
    // 文字列の数字を整数に変換。

    $.ajax({
    // Lavelのコントローラーにいいね処理を送るための記述
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      // LavelのCSRF対策。必須項目。
      method: "post",
      // POSTで送信。web.phpで書いたルートの記述からどちらで書いたか確認。web.php 62行目
      url: "/like/post/" + post_id,
      // 送信先のURL　web.php 62行目に記載。 /like/post/受け取った投稿の番号
      data: {
        post_id: $(this).attr('post_id'),
        // コントローラーにもpost_idを渡す。
      },
    }).done(function (res) {
      // Ajax成功時の処理を開始。
      console.log(res);
      $('.like_counts' + post_id).text(countInt + 1);
      // 画面でいいねの数を1増やす。
    }).fail(function (res) {
      // 失敗時
      console.log('fail');
    });
  });
// いいね解除する時に動く処理31行目～52行目まで
  $(document).on('click', '.un_like_btn', function (e) {
    // いいね解除ボタンを押した時
    e.preventDefault();
    $(this).removeClass('un_like_btn');
    // 解除ボタン クラスを外す
    $(this).addClass('like_btn');
    // いいねするボタンにクラスを付け直す ボタンが元の状態に戻る。
    var post_id = $(this).attr('post_id');
    // 投稿IDを再取得。
    var count = $('.like_counts' + post_id).text();
    // 36行目はpostsブレードの.like_countsとpost_idが一緒に書いてある記述で動く。
    // 現在のいいね数取得。
    var countInt = Number(count);
    // 数字に変換

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unlike/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.like_counts' + post_id).text(countInt - 1);
      // いいねの数を1減らす。
    }).fail(function () {

    });
  });

  $('.edit-modal-open').on('click',function(){
    $('.js-modal').fadeIn();
    var post_title = $(this).attr('post_title');
    var post_body = $(this).attr('post_body');
    var post_id = $(this).attr('post_id');
    $('.modal-inner-title input').val(post_title);
    $('.modal-inner-body textarea').text(post_body);
    $('.edit-modal-hidden').val(post_id);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});
