<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>articles/show</title>
</head>

<body>
    <h1>論文詳細</h1>
    <h1>{{ $article->title }}</h1>
    <p>{!! nl2br(e($article->body)) !!}</p>
    <button onclick="location.href='{{ route('articles.index') }}'">一覧に戻る</button>
    <div class="button-group">
        <!-- $memoのidを元に編集ページへ遷移する -->
        <button onclick="location.href='{{ route('articles.edit', $article) }}'">編集する</button>
        <form action="{{ route('articles.destroy', $article) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="削除する" onclick="if(!confirm('削除しますか？')){return false};">
        </form>
    </div>
</body>

</html>
