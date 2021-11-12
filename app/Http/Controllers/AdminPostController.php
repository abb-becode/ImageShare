<?php

  namespace App\Http\Controllers;

  //use App\Http\Requests\PostRequest;
  use App\Models\Post;
  use Illuminate\Support\Str;
  use Illuminate\Validation\Rule;
  use Illuminate\Http\Request;

  class AdminPostController extends Controller
  {
      // Add index action
      public function index()
      {
          return view('admin.posts.index', [
             'posts' => Post::paginate(50),
          ]);
      }

      public function create()
      {
        /*if (auth()->guest()) {
            //abort(403);
            abort(Response::HTTP_FORBIDDEN);
        }*/

        /*if (auth()->user()?->username !== 'abb') {
            abort(Response::HTTP_FORBIDDEN);
        }*/

        return view('admin.posts.create');
      }

      public function store()
      //public function store(PostRequest $postRequest)
      {
        //ddd(request()->all());

        //$path = request()->file('thumbnail')->store('thumbnails');
        //return ('Done: ') . $path;

        /** The same code in the update method
         try to extract protected method */

        /** Method extracted <=> validatePost() */
        /*$attributes = request()->validate([
          'title' => 'required',
          //'thumbnail' => 'required|image',
          'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],*/

          /** when Laravel create a post, there is no id, which mean Laravel not ignore anything */
          /*//'slug' => ['required', Rule::unique('posts', 'slug')],
          'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
          'excerpt' => 'required',
          'body' => 'required',
          'category_id' => ['required', Rule::exists('categories', 'id')],
          'published_at' => 'required'
        ]);*/

        /** we don't need to pass a new post to the validate method
        // but null can be passed this method */
        //$attributes = $this->validate(new Post());
        /** use merge_array to group all attributes */
        /*$attributes = $this->validatePost();
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');*/

        /** with var  $attributes */
        //request()->slug = Str::slug(request()->title, '-');
        $attributes = array_merge($this->validatePost(), [
          'user_id' => request()->user()->id,
          'thumbnail' => request()->file('thumbnail')->store('thumbnails'),
        ]);


        //$postRequest = new PostRequest();
        //$attributes = array_merge($postRequest->validate(), [
        //$attributes = $postRequest->rules();
//        $attributes = [
//          'title' => $postRequest['title'],
//          'slug' => $postRequest['slug'],
//          'excerpt' => $postRequest['excerpt'],
//          'body' => $postRequest['body'],
//          'category_id' => $postRequest['category_id'],
//          'user_id' => request()->user()->id,
//          'thumbnail' => request()->file('thumbnail')->store('thumbnails'),
//        ];
        //]);

        Post::create($attributes);


        /** Or inline attributes variable */
        /*Post::create(array_merge($this->validatePost(), [
          'user_id' => request()->user()->id,
          'thumbnail' => request()->file('thumbnail')->store('thumbnails'),
        ]));
        */

        /** or without specifying user_id by using user() method and relationship between users and posts tables*/
        // request()->user()->posts()->create();

        return redirect('/');
      }

      public function edit(Post $post)
      {
        return view('admin.posts.edit', ['post' => $post]);
      }

      public function update(Post $post)
      {

        /** Method extracted <=> validatePost() */
        /*$attributes = request()->validate([
          'title' => 'required',
          //'thumbnail' => 'image',
          'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
          // we don't need to specify id, when passed model laravel automatically grape the primary key
          //'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
          'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
          'excerpt' => 'required',
          'body' => 'required',
          'category_id' => ['required', Rule::exists('categories', 'id')],
          'published_at' => 'required'
        ]);*/

        $attributes = $this->validatePost($post);
        //$attributes = $postRequest->rules($post);

        // if (isset($attributes['thumbnail'])) {
        /** using null safe operator */
        /** check that post has a thumbnail, but assume that you don't have one */
        if ($attributes['thumbnail'] ?? false) {
          $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
      }

      public function destroy(Post $post)
      {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
      }

    /** Null can be passed to this method */
    protected function validatePost(?Post $post = null): array
    {
      /** if we have a post we want to use that, if no we create a new one */
      $post ??= new Post();

      //$post->title = request()->title;
      //$post->slug = Str::slug($post->title, '-');
      //ddd('end', $post->slug);
      //$title = request()->title;
      //$post->slug = Str::slug($title);

      return request()->validate([
        'title' => 'required',
        //'thumbnail' => 'image',
        'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
        // we don't need to specify id, when passed model laravel automatically grape the primary key
        //'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
        'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
        'excerpt' => 'required',
        'body' => 'required',
        'category_id' => ['required', Rule::exists('categories', 'id')],
        // 'published_at' => 'required'
      ]);
    }

  }
