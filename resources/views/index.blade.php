@extends('layouts.main')

@section('content')
    <div>
        <form class="flex justify-center" action="{{ route('posts.search') }}">
            <input
                class="py-3
                    w-8/12
                    px-4
                    block
                    border-gray-200
                    rounded-lg
                    text-sm
                    focus:border-blue-500
                    focus:ring-blue-500
                    disabled:opacity-50
                    disabled:pointer-events-none
                    dark:bg-blue-100
                    dark:border-gray-700
                    dark:text-gray-400
                    dark:focus:ring-gray-600"
                type="text"
                placeholder="Search By Post Title"
                name="query"
            />
        </form>
        <div class="flex flex-col-reverse md:flex-row md:justify-between text-white pt-5">
            <div class="m-3 flex-1 lg:block hidden">
                <x-follow-list />
            </div>
            <div class="m-3 flex-1">
                <x-recent-posts :posts="$posts" />
            </div>
            <div class="m-3 flex-1 md:block ">
                <x-create-post />
            </div>
        </div>
    </div>
@endsection

