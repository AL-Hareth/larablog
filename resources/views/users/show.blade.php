@extends('layouts.main')

@php
$posts = $user->posts();
@endphp

@section('content')

<div class="text-gray-300 border border-gray-500 py-4 px-5 rounded-lg mb-4">
    <h3 class="text-2xl font-semibold pb-3 text-center">{{ $user->name }}</h3>
    <p class="text-lg pb-3">Joined: {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p>
    <p class="text-lg pb-3">Posts: {{ $posts->count() }} posts</p>
    <p class="text-lg pb-3">followers: {{ $user->followers()->count() }} follower</p>

    @if(auth()->check() && auth()->user()->id != $user->id)
    @if(auth()->user()->followees()->find($user->id))

    <form method="post" action="{{ route('users.unfollow', $user->id) }}">
        @csrf
        <button class="text-lg pb-3 bg-gray-500 hover:bg-gray-700 text-gray-200 font-bold py-2 px-4 rounded">Following</button>
    </form>

    @else

    <form method="post" action="{{ route('users.follow', $user->id) }}">
        @csrf
        <button class="text-lg pb-3 bg-cyan-500 hover:bg-cyan-700 text-gray-200 font-bold py-2 px-4 rounded">Follow</button>
    </form>
    @endif
    @endif
</div>

@if($posts->count() > 0)
<div>
    <h3 class="text-2xl font-semibold pb-3 text-gray-300">Posts:</h3>
    @foreach($posts->get() as $post)
    <div class="text-gray-300 shadow shadow-gray-300/50 py-4 px-5 rounded-lg mb-4">
        <a href="{{ route('posts.show', $post->id) }}" class="pb-3 flex flex-col sm:flex-row justify-between sm:items-center">
            <h3 class="inline text-2xl font-semibold pb-3 underline">{{ $post->title }}</h3>
            <span>{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
        </a>
        <span>{{ strlen($post->content) > 100 ? substr($post->content, 0, 100) . "..." : $post->content }}</span>
    </div>
    @endforeach
</div>
@else
<div class="text-gray-300 border border-gray-500 py-4 px-5 rounded-lg text-3xl text-center">This user has no posts... come back later :)</div>
@endif

@endsection
