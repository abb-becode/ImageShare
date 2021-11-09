
  @props(['posts'])

  {{--<x-post-featured-card :post="$posts[0]" />--}}

  @if ($posts->count() >= 1)
      <div class="lg:grid lg:grid-cols-6">
  {{--        @foreach ($posts->skip(1) as $post)--}}
          @if($posts->count() == 1)
{{--            @foreach ($posts as $post)--}}
              <x-post-card
                :post="$posts[0]"
                class="col-span-full"
              />
{{--            @endforeach--}}
          @else
            @foreach ($posts as $post)
                <x-post-card
                    :post="$post"
  {{--                  class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"--}}
  {{--                  class="{{ $loop->iteration === 1 ? 'col-span-2' : 'col-span-full' }}"--}}
                    class="col-span-2"
                />
            @endforeach
          @endif
      </div>
  @endif
