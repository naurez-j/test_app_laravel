<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="text-end">
    <a href="{{ route('posts.edit', $post->id) }}"
        class="mx-1 btn btn-outline-success btn-icon waves-effect waves-light editBtn">
        <i class="ri-edit-2-line"></i>
    </a>

<button type="button" data-id="{{ $post->id }}"
    class="mx-1 btn btn-outline-danger btn-icon waves-effect waves-light deleteBtn">
    <i class="ri-delete-bin-6-line"></i>
</button>
</div>
