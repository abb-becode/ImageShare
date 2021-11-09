<?php

    /*use Illuminate\Support\Facades\DB;*/
    /*use Illuminate\Support\Facades\File;*/
    /*use Spatie\YamlFrontMatter\YamlFrontMatter;*/

    use App\Http\Controllers\AdminPostController;
    use App\Http\Controllers\NewsletterController;
    use App\Http\Controllers\PostCommentsController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\RegisterController;
    use App\Http\Controllers\SessionsController;
    //use App\Services\Newsletter;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Validation\ValidationException;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */


    /** Seven REST actions */
    // 1- index => show all resources,
    // 2- show => show one resource
    // 3- create => show a page to create a new item
    // 4- store => when you submit that form, persist the item
    // 5- edit => show a page to edit the item
    // 6- update => when you submit that form, update the item
    // 7- destroy => destroy the item


    Route::get('/', [PostController::class, 'index'])->name('home');

    Route::get('posts/{post:slug}', [PostController::class, 'show']);
    Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

    Route::post('newsletter', NewsletterController::class);

    Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
    Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

    Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
    Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

    Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

    /** Admin section */
    /** 1- We removed "MustBeAdministrator" Middleware because we define a Gate ability,
     *     we can reference that as a middleware and use "can" with calling ability named "admin" like this 'can:admin'
     *     if we need pass parameters we use it like this 'can:admin, params', but here we don't have parameters
     *  2- we group all route using the same middleware, in this case "can:admin" in a closure
     *  3- we almost type the 7 actions resources for a controller : index(show),store,create,edit,update and destroy
     *     -- use in the terminal this command : php artisan route:list
     *     Replace all Routes with Route::resource because we respect the REST command appellation
     *
     *   NB : It's not really matter but little cleaner
     */
    Route::middleware('can:admin')->group(function() {
      Route::resource('admin/posts', AdminPostController::class)->except('show');
//      Route::get('admin/posts', [AdminPostController::class, 'index']);
//      Route::post('admin/posts', [AdminPostController::class, 'store']);
//      Route::get('admin/posts/create', [AdminPostController::class, 'create']);
//      Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
//      Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
//      Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
    });



//    Route::get('categories/{category:slug}', function (Category $category) {
//        return view('posts', [
//            // we remove this ->load(['category', 'author']) because $with in the Post model
//            'posts' => $category->posts,
//            'currentCategory' => $category,
//            'categories' => Category::all()
//        ]);
//
//    })->name('category');

//    Route::get('authors/{author:username}', function (User $author) {
//        return view('posts.index', [
//            'posts' => $author->posts
//            /*'categories' => Category::all()*/ // we don't need this because we define it in CategoryDropDown view component
//        ]);
//    });
