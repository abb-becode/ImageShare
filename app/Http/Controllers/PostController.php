<?php

    namespace App\Http\Controllers;

    //use App\Models\Category;
    use App\Models\Post;
    use Illuminate\Support\Facades\Gate;

    //use Illuminate\Validation\Rule;

    //use Illuminate\Http\Request;

    class PostController extends Controller
    {
        public function index()
        {
            // returning eloquent collection from a route
            // in the browser the result will be displayed as json
            /*return Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(3);*/

            /*return view('posts.index', [
                'posts' => Post::latest()->filter(
                    request(['search', 'category', 'author'])
                )->get()
            ]);*/


          /**
           * can or cannot method return a boolean, we can check if true or not
           * authorize method display a page with 403 error message
           */
          //dd(Gate::allows('admin'));
          //dd(request()->user()->can('admin'));
          //$this->authorize('admin');

          /** Use simplePaginate(6) instead paginate(6) to show only two buttons 'Next' and 'Previous'
              Use withQueryString() method to include existing query string */
          return view('posts.index', [
              'posts' => Post::latest()->filter(
                          request(['search', 'category', 'author'])
                      )->paginate(6)->withQueryString()
          ]);

        }

        public function show(Post $post)
        {
            return view('posts.show', [
                'post' => $post
            ]);
        }

        // Methods create and store was moved to AdminPostController
//        public function create()
//        {
//            /*if (auth()->guest()) {
//                //abort(403);
//                abort(Response::HTTP_FORBIDDEN);
//            }*/
//
//            /*if (auth()->user()?->username !== 'abb') {
//                abort(Response::HTTP_FORBIDDEN);
//            }*/
//
//            return view('admin.posts.create');
//        }

//        public function store()
//        {
//            //ddd(request()->all());
//
//            // $path = request()->file('thumbnail')->store('thumbnails');
//            // return ('Done: ') . $path;
//
//            $attributes = request()->validate([
//                'title' => 'required',
//                'thumbnail' => 'required|image',
//                'slug' => ['required', Rule::unique('posts', 'slug')],
//                'excerpt' => 'required',
//                'body' => 'required',
//                'category_id' => ['required', Rule::exists('categories', 'id')]
//            ]);
//
//            $attributes['user_id'] = auth()->id();
//            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
//
//            Post::create($attributes);
//
//            return redirect('/');
//        }

    }
