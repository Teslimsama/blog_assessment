
@auth
<form action="{{ route('comment.store', ['blog' => $blog->id]) }}" method="post" class="mb-5">

    @csrf

    <input type="text" name="body" class="" placeholder="Enter Comment">
<input type="hidden" name="blog_id" value="{{ $blog->id }}">

    <button type="submit" class="font-semibold text-white text-sm p-2 px-4 bg-green-700">Submit</button>
</form>
@endauth
