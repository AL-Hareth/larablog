@extends('layouts.main')

@section('content')
    <div>
        <div class="flex justify-between text-white pt-5">
            <div class="m-3 flex-1">
                <x-follow-list />
            </div>
            <div class="m-3 flex-1">
                <x-recent-posts />
            </div>
            <div class="m-3 flex-1">
                <x-create-post />
            </div>
        </div>
    </div>
@endsection
