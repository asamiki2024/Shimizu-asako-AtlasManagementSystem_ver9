$(function () {
    $(document).on('click', '.like_btn, .un_like_btn',  function(){
        let post_id = $(this).data('post_id');
        let $this = $(this);
    //2～4行目の解説
    // 2行目 document(ページ全体)に対して.like_btnまたは.un_like_btnがクリックされるとfunctionの中身が動く
    // documentはハートのいいねボタン(like/unlike)はAjax後にクラスが切り替わるように監視している働きがある。
    // 3行目 クリックされた要素(this= タグ)、post_id="〇〇"の値を取得する。
    // Ajaxでどの投稿をlike/unlikeするのかを伝えるため。
    // 4行目 this(クリックされたハートのいいねボタン)をjQueryオブジェクトとして$thisに入れておく。
    // success内でthisがAjaxのcontextに変化するのでクリックの内容を保持する為。
        $.ajax({
            url: '/like',
            type:'POST',
            data: {
                post_id: post_id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
        //12～19行目の解説
        // 12行目 ここからAjax(非同期通信)を開始する。
        // 13行目 POSTを送る先のURL→web.phpに定義された/like
                //数字更新
                $this.next('.like_counts').text(response.like_count);

                //クラスの切り替え
                if($this.hasClass(is_liked)){
                    //未いいね→いいね
                    $this.removeClass('like_btn')
                        .addClass('un_like_btn');
                } else {
                    //いいね解除
                    $this.removeClass('un_like_btn')
                        .addClass('like_btn');
                }
            }
        // }).done(function (data) {
        //     //ハートの切り替え
        //     if(data.is_liked){
        //         $btn.removeClass('heart').addClass('heart_red');
        //     } else {
        //             $btn.removeClass('heart_red').addClass('heart');
        //     }
        //     //カウント更新
        //     $btn.closest('.post_status')
        //             .find('.like_counts')
        //             .text(data.like_count);
        // }).fail(function () {
        //         alert('通信エラーが発生しました。');
        // });
        });
    });
});