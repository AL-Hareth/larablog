<div class="sticky top-10 flex flex-col items-stretch shadow shadow-cyan-500/50 rounded-lg py-4">
    @if(auth()->check())
    <h2 class="text-2xl font-semibold pb-3 text-center">Write Something...</h2>

    <form method="post" action="{{ route('posts.create') }}" class="flex flex-col items-stretch px-3">
        @csrf
        <input type="text" name="title" placeholder="Title"
            class="border border-cyan-500 p-2 m-2 rounded-md overflow-ellipsis bg-transparent" />
        <textarea name="content" placeholder="Content"
            class="border border-cyan-500 p-2 m-2 rounded-md overflow-ellipsis bg-transparent min-h-[200px]" ></textarea>
        <button class="bg-cyan-500 text-white p-2 m-2 rounded-md">Post</button>
    </form>
    @else
    <h2 class="text-xl font-semibold pb-3 text-center">Log in to write a post</h2>
    @endif
</div>
