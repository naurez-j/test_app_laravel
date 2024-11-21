<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
</head>

<body>
    <h1>EDIT POST</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>Title</p>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
        <p>Description</p>
        <input type="text" name="description" id="description" value="{{ old('description', $post->description) }}">
        <p>Is Liked</p>
        <input type="hidden" name="is_liked" value="0"> <!-- Default value -->
        <input type="checkbox" name="is_liked" id="is_liked" value="1"
            {{ old('is_liked', $post->is_liked) ? 'checked' : '' }}>
        <label for="is_liked">Like this post</label>
        <button type="submit">Submit</button>

    </form>
</body>

</html>
