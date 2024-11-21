<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form id="storePostForm" action="{{ route('posts.store') }}" method="POST">
        @csrf
        <p>Title</p>
        <input type="text" name="title" id="title">
        <p>Description</p>
        <input type="text" name="description" id="description">
        <button type="submit">Submit</button>
    </form>

</body>
</html>
