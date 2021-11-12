<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(?Post $post = null): array
    {
      //ddd($post);
      /** if we have a post we want to use that, if no we create a new one */
      $post ??= new Post();

      return $this->validatePost($post);
    }

    public function messages()
    {
      return [
        'title.required' => 'The ttitle field is required.',
        'thumbnail.required' => 'The tthumbnail field is required.',
        'slug.required' => 'The sslug field is required.',
        'slug.unique' => 'The sslug has already been taken.',
        'excerpt.required' => 'The eexcerpt field is required.',
        'body.required' => 'The bbody field is required.',
        'category_id.required' => 'The ccategory field is required.',
      ];
    }

    protected function validatePost(Post $post): array
    {
      //return $this->validate([
      return [
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
      ];
    }

}
