<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request) {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = $request->user()->id;
        $post->created_at = now();
        $post->updated_at = now();
        $post->save();
        return redirect('/');
    }

    public function show($id) {
        $post = Post::find($id);

        if (!$post) {
            return abort(404);
        }

        return view('posts.show', ['post' => $post]);
    }

    public function comment($id, Request $request) {
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = $request->user()->id;
        $comment->post_id = $id;
        $comment->created_at = now();
        $comment->updated_at = now();
        $comment->save();
        return redirect("/posts/{$id}");
    }

    public function like($id, Request $request) {
        $like = new Like();
        $like->user_id = $request->user()->id;
        $like->post_id = $id;
        $like->created_at = now();
        $like->updated_at = now();

        $like->save();

        return redirect("/posts/{$id}");
    }

    public function dislike($id, Request $request) {
        $like = Like::where(['user_id' => $request->user()->id, 'post_id' => $id]);
        $like->delete();

        return redirect("/posts/{$id}");
    }

}
