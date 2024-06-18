<x-home-layout>
    <!-- Main Content -->
    <main class="container  p-1 mt-5 rounded  mx-auto px-6 py-8">

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <a href="{{ route('home') }}" class="text-white bg-blue-600 p-2 rounded px-4 block mb-5 w-max">All
                    Blog</a> <br>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        @if( $blog->thumbnail !== null && $blog->thumbnail->url !== null )
                        <img src="{{ $blog->thumbnail->url }}" class="w-[300px] h-[200px] md:h-[300px] object-cover"
                            alt="{{ $blog->title }}">
                        @endif

                        <div class="flex gap-1 flex-col mt-3">
                            <span class="font-semibold">{{ __('Author') }}:</span>
                            <span>{{ $blog->user->name }}</span>
                        </div>

                        <div class="flex flex-col gap-1 mt-5">
                            <span class="font-semibold">{{ __('Title') }}:</span>
                            <span>{{ $blog->title }}</span>
                        </div>


                        <div class="flex flex-col gap-1 mt-5">
                            <span class="font-semibold">{{ __('Description') }}:</span>
                            <span>{{ $blog->body }}</span>
                        </div>


                        {{-- Comments --}}
                        <div class="block relative mt-5">
                            <div class="font-semibold mt-10 relative block uppercase text-lg">Comments</div>

                            @include('blog.comments.form')
                            @forelse ($comments as $comment )


                                <div class="flex flex-col mb-1 p-2">

                                    <div class="flex justify-between">

                                    <span class="text-sm font-semibold">{{ $comment->user->name }}</span>
                                    <span class="text-xs">{{ $comment->created_at }}</span>
                                    </div>

                                    <span>{{ $comment->body }}</span>
                                </div>

                            @empty

                                <span class="h-[200px] flex place-content-center place-items-center">No Comment Found</span>

                            @endforelse
                        </div>
                    </div>


                </div>



                <div class="flex flex-row md:flex-col justify-between">
                    {{-- Prev Blog --}}

                    @if ($prev_blog_id !== null)
                        <a href="{{ route('blog.show', ['blog' => $prev_blog_id]) }}"
                            class="text-white bg-blue-600 p-2 rounded px-4 block mt-5 w-max">
                            << Prev Blog</a>
                    @endif

                    @if ($next_blog_id !== null)
                        {{-- Next Blog --}}
                        <a href="{{ route('blog.show', ['blog' => $next_blog_id]) }}"
                            class="text-white bg-blue-600 p-2 rounded px-4 block mt-5 w-max">Next Blog >></a>
                    @endif

                </div>
            </div>

        </div>
    </main>


</x-home-layout>
