<?php

namespace App\Models;


use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // see AppServiceProvider.php in Providers folder
    //protected $guarded = [];

    public function post() // post_id probably
    {
        return $this->belongsTo(Post::class);
    }

    public function author() // author_id probably but not it is, because of that must specify column user_id
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
