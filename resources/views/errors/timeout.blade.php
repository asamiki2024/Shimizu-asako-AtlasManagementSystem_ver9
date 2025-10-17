{{-- resources/views/errors/timeout.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>セッションタイムアウト</title>
        <style>
            body {
                font-family: "Hiragino Kaku Gothic ProN", sans-serif;
                /* ボディの中身は後で記入 */
            }
        </style>
        <!-- 3秒後にログインページへ移動 -->
        <script>
            setTimeout(function(){
                window.location.href = "{{ route('login') }}";
            }, 3000);
        </script>
    </head>
    <body>
        <hi>セッションがタイムアウトしました。</hi>
        <p>3秒後にログインページへ戻ります。</p>
    </body>
</html>