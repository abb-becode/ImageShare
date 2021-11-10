
    <x-layout>

        <x-setting heading="Publish New Post">
            <form method="POST" action="/admin/posts" enctype="multipart/form-data">
                @csrf

                <x-form.input name="title" id="title" />
                <x-form.input name="slug" id="slug" readonly />
                <x-form.input name="thumbnail" type="file" />
                <x-form.textarea name="excerpt" />
                <x-form.textarea name="body" />

                <x-form.field>
                    <x-form.label name="category" />

                    <select name="category_id" id="category_id">
                        @foreach (\App\Models\Category::all() as $category)
                            <option
                                value={{ $category->id }}
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ ucwords($category->name) }}
                            </option>
                        @endforeach
                    </select>

                    <x-form.error name="category" />
                </x-form.field>

                <x-form.button>Publish</x-form.button>

            </form>
        </x-setting>

    </x-layout>
    
    <script>

      /* Encode string to slug */

      const title = document.getElementById('title');
      title.addEventListener('keyup', () => {
        const str = title.value;
        const slug = document.getElementById('slug');

        slug.value = slugify(str);
      });

      const slugify = text =>
        text
          .trim() // trim spaces from beginning and end of the string
          .toLowerCase() // convert string to lowercase letters
          .replace(/[^\w\s-/]/g, "") //  remove non word characters except -, whitespaces and /
          .replace(/[\s-_/]+/g, "-") // replace multiple _, -, / and whitespaces with -
          .replace(/^-+/, "") // remove - from beginning
          .replace(/-+$/, ""); // remove - from end

    </script>
