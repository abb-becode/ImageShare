<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use PhpParser\Comment;
//use App\Models\Comment;
//use App\Models\User;
//use App\Models\Category;

class Post extends Model
{
    // any post created has access to this method Post::factory()
    use HasFactory;

    // Mass Assignment

    // First method
    //protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id']; // id can take value also

    // Second Method
    //protected $guarded = ['id']; // all field can take value except id
    // see AppServiceProvider.php in Providers folder
    //protected $guarded = [];

    // Eager Load relationships on an Existing Model
    // Is default for every Post query
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)  // Post::newQuery()->filter()
    {
        // query where
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            // give one has a category when a category slug match with searched string
            $query->whereHas('category', fn($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            // give one has a author when a username match with searched string
            $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );

    }

    public function comments() {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasMany(Comment::class);
    }

    public function category() {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author() {    //our code reflect a way you speak
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(User::class, 'user_id');
    }

}

