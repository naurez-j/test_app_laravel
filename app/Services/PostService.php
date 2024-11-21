<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    /**
     * Get all posts.
     */
    public function getAllPosts()
    {
        return Post::all();
    }

    /**
     * Store a new post.
     */
    public function storePost(array $data)
    {
        return Post::create($data);
    }

    /**
     * Update an existing post.
     */
    public function updatePost(Post $post, array $data)
    {
        return $post->update($data);
    }

    /**
     * Delete a post.
     */
    public function deletePost(Post $post)
    {
        return $post->delete();
    }
}
