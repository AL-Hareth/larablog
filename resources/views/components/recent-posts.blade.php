@props(['posts'])

<?php


$postsList = request()->query('query') ? $posts : [];

if(!request()->query('query')) {
    if(auth()->check() && auth()->user()->followees()->count() > 0) {
        $followedUsers = auth()->user()->followees()->get();

        foreach ($followedUsers as $followedUser) {
            array_push($postsList, ...$followedUser->posts()->get());
        }

        array_push($postsList, ...auth()->user()->posts()->get());
        shuffle($postsList);
    } else {
        $all = App\Models\Post::all();
        $postsList = $all->count() > 5 ? $all->random(5) : $all->random($all->count());
    }
}

?>

@if(count($postsList) > 0)
@foreach($postsList as $post)
<div class="text-gray-300 border border-gray-500 py-4 px-5 rounded-lg mb-4">
    <h3 class="my-3 flex flex-col sm:flex-row justify-between">
        <a class="text-2xl hover:text-white transition ease-in-out delay-150" href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a>
        <span class="text-sm sm:text-md">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
    </h3>
    <p class="text-xl underline mb-4"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></p>
    <p class="text-md">{{ $post->content }}</p>
    <button title="Login to like" class="text-xl text-gray-300 flex items-center justify-around"><ion-icon name="heart"></ion-icon><span class="ml-2">{{ $post->likes->count() }}</span></button>
</div>
@endforeach
@else
<div class="text-gray-300 border border-gray-500 py-4 px-5 rounded-lg text-3xl text-center">This user has no posts... come back later :)</div>
@endif
