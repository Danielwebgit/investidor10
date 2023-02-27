<?php

namespace App\Services\Post;

use App\Models\Post;

class PostService
{

    public function commonFormDataPost(array $postData)
    {
        return [
            'title' => $postData['title'],
            'text' => $postData['text'],
            'user_id' => $postData['user_id']
        ];
    }

}
