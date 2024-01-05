@extends('layouts.main')

@php
$likes = $post->likes->toArray();
$isCurrentUserLiked = false;
if (auth()->check()) {
    foreach ($likes as $like) {
        if ($like['user_id'] == auth()->user()->id) {
            $isCurrentUserLiked = true;
            break;
        }
    }
}
@endphp

@section('content')

<div class="text-gray-300 border border-gray-500 py-4 px-5 rounded-lg mb-4">
    <h3 class="text-2xl font-semibold pb-3 text-center">{{ $post->title }}</h3>
    <p class="text-center text-gray-400 pb-3">By: {{ $post->user->name }}</p>
    <p class="text-center text-gray-400 pb-3">Written {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</p>
    <p class="text-lg text-center pb-3">{{ $post->content }}</p>
    @if(auth()->check())
    <form method="post" action="{{ $isCurrentUserLiked ? route('posts.dislike', $post->id) : route('posts.like', $post->id) }}">
        @csrf
        <button class="text-xl {{ $isCurrentUserLiked ? 'text-cyan-500' : 'text-gray-300' }} flex items-center justify-around"><ion-icon name="heart"></ion-icon><span class="ml-2">{{ $post->likes->count() }}</span></button>
    </form>
    @else
    <button title="Login to like" class="text-xl {{ $isCurrentUserLiked ? 'text-cyan-500' : 'text-gray-300' }} flex items-center justify-around"><ion-icon name="heart"></ion-icon><span class="ml-2">{{ $post->likes->count() }}</span></button>
    @endif
</div>

<!-- add Comment -->

@if(auth()->check())

<div class="text-gray-300 border border-gray-500 py-4 px-5 rounded-lg mb-4">
    <h3 class="text-2xl font-semibold pb-3">Add Comment</h3>
    <form method="post" action="{{ route('posts.comment', $post->id) }}">
        @csrf
        <div class="flex flex-col items-stretch sm:flex-row justify-between sm:items-center">
            <input type="text" class="flex-1 text-gray-300 border border-gray-500 p-2 sm:mr-2 rounded-lg bg-slate-900" name="content" placeholder="Add a comment" />
            <button class="bg-cyan-500 text-white p-2 rounded-md mt-2 sm:mt-0">Submit your Comment</button>
        </div>
    </form>
</div>

@endif

<!-- Comments -->
<div>
    <h3 class="text-2xl text-gray-300 font-semibold pb-3">Comments ({{ $post->comments->count() }})</h3>
    <hr class="border-gray-500 mb-3" />
    @foreach($post->comments->reverse() as $comment)
    <div class="text-gray-300 shadow shadow-gray-300/50 py-4 px-5 rounded-lg mb-4">
        <a href="{{ route('users.show', $comment->user->id) }}">
            <h3 class="inline text-2xl font-semibold pb-3 underline">{{ $comment->user->name }}</h3>
        </a>
        <span>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
        <p>{{ $comment->content }}</p>
    </div>
    @endforeach
</div>

@endsection
