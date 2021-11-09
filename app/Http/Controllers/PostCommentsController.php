<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {
        // Validate => request validation
        request()->validate([
           'body' => 'required'
        ]);

        // Perform an action => create comment
        $post->comments()->create([  // automatically set the post_id from $post
            'user_id' => request()->user()->id,
            'body' => request('body')
        ]);

        // Redirect => go back to the previous page
        return back();
    }
}

