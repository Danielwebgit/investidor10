<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Services\Post\PostService;

class PostRepository implements PostRepositoryInterface 
{

    protected $model;
    protected $postService;

    public function __construct(Post $model, PostService $postService)
    {
        $this->model = $model;
        $this->postService = $postService;
    }

    public function getAllPosts() 
    {
        return $this->model->with('user')->get();
    }

    public function getPostById($postId) 
    {
        return $this->model->findOrFail($postId);
    }

    public function deletePost($postId) 
    {
        return $this->model->destroy($postId);
    }

    public function createPost(array $postDetails) 
    {
        $postDetails = $this->postService->commonFormDataPost($postDetails);
        return $this->model->create($postDetails);
    }

    public function updatePost($postId, array $newDetails) 
    {
        $newDetails = $this->postService->commonFormDataPost($newDetails);
        return $this->model->whereId($postId)->update($newDetails);
    }

}