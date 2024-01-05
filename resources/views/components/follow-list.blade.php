@php
    $followees = auth()->check() ? auth()->user()->followees()->get() : [];
@endphp

<div class="sticky top-10 flex flex-col items-center shadow shadow-cyan-500/50 rounded-lg py-4">
    <h2 class="text-center text-2xl font-semibold pb-3">People You Are Following</h2>
    @if(auth()->check())
    @foreach($followees as $followee)
        <a
            href="{{ route('users.show', $followee->id) }}"
            class="border border-cyan-500 p-2 m-2 rounded-md w-1/2 overflow-ellipsis"
        >{{ $followee->name }}</a>
    @endforeach
    @else
        <div>
            <span><a href="{{ route('login') }}" class="text-blue-600">Login </a>to view your follow list</span>
        </div>
    @endif
</div>
