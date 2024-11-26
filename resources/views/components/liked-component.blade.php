<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="heart-icon" data-id="{{ $post->id }}" data-liked="{{ $post->is_liked }}">
    <i class="{{ $post->is_liked ? 'fas fa-heart text-danger' : 'far fa-heart text-dark' }}"></i>
</div>

