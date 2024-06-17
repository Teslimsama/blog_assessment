<x-home-layout>
    <!-- Main Content -->
    <main class="container  p-1 mt-5 rounded  mx-auto px-6 py-8">

        <div class="grid grid-cols-4 gap-5">
            @include('blog.index')
        </div>

        @if (count($blogs) > 0)
            <div class="p-3 mt-3">
                {{-- Pagination --}}
                {{ $blogs->links('pagination::tailwind') }}
            </div>
        @else
            <span class="h-[200px] text-black w-full flex place-content-center place-items-center">No Blog Found</span>
        @endif
    </main>


</x-home-layout>
