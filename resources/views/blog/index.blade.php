@foreach ($blogs as $blog)
    <article class="flex gap-2 flex-col bg-white shadow-md">
        <img src="{{ $blog->thumbnail->url }}" class="bg-red-200 w-full h-[200px] object-cover" alt="{{ $blog->title }}">
        <div class="flex flex-col p-2">
            <span class="font-semibold text-lg capitalize"> {{ $blog->title }} </span>

            <span class="font-normal text-sm">{{ $blog->caption }} </span>
            {{-- <span class="font-normal text-sm">{{ $blog->created_at }} </span> --}}
            <span class="font-normal text-sm">{{ \Carbon\Carbon::parse( $blog->created_at )->diffForHumans() }} </span>
            <a href="{{ route('blog.show', ['blog' => $blog->id]) }}"
                class="text-blue-500 hover:underline mt-4 block">Read
                more</a>

        </div>
    </article>
@endforeach
