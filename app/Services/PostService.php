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
     * Get a post by ID.
     *
     * @param int $id
     * @return Post
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getPostById(int $id): Post
    {
        return Post::findOrFail($id);
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
