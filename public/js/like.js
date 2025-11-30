$(function () {
    $(document).on('click', '.like_btn, .un_like_btn',  function(){
        let post_id = $(this).attr('post_id');
        let $btn = $(this);

        $.ajax({
            url: '/posts/like',
            type:'POST',
            data: {
                post_id: post_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (data) {
            //ハートの切り替え
            if(data.is_liked){
                $btn.removeClass('heart').addClass('heart_red');
            } else {
                    $btn.removeClass('heart_red').addClass('heart');
            }
            //カウント更新
            $btn.closest('.post_status')
                    .find('.like_counts')
                    .text(data.like_count);
        }).fail(function () {
                alert('通信エラーが発生しました。');
        });
    });
});