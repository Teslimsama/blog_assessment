{{-- Title --}}
<label for="title" class="flex flex-col font-semibold mt-5">
    <span>{{ __('Title') }}</span>
    <input
        class="border border-gray-400 font-normal focus:border-blue-500 text-gray-700 rounded placeholder:text-gray-200 @error('title') border-red-500 @enderror"
        type="text" name="title" id="title" placeholder="Enter Blog Title..." value="{{ old('title') ?? $blog->title }}">

    @error('title')
        <span class="text-xs text-red-600">{{ $errors->first('title') }}</span>
    @enderror
</label>

{{-- Body --}}
<label for="body" class="flex flex-col font-semibold mt-5">
    <span>{{ __('Body') }}</span>
    <textarea
        class="border border-gray-400 font-normal focus:border-blue-500 text-gray-700 rounded placeholder:text-gray-200 @error('body') border-red-500 @enderror"
        type="text" name="body" id="body" placeholder="Enter Body/Description" >{{ old('blog') ?? $blog->body }}</textarea>

    @error('body')
        <span class="text-xs text-red-600">{{ $errors->first('body') }}</span>
    @enderror
</label>




{{-- Featured Image --}}
<label for="featured_image" class="flex flex-col my-5">

    <span class="font-semibold ">Featured Image</span>

    @isset($blog->thumbnail)
        @if ($blog->thumbnail->url !== null)
            <img class="h-[200px] w-[200px] object-cover mb-3" src="{{ $blog->thumbnail->url }}" alt="{{ $blog->title }}">
        @endif
    @endisset
    <input type="file" name="featured_image" id="">
    @error('featured_image')
        <span class="text-xs text-red-600">{{ $errors->first('featured_image') }}</span>
    @enderror
</label>
