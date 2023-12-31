<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return abort(404);
        }
        return view('users.show', ['user' => $user]);
    }

    public function follow($id)
    {
        $user = User::find($id);
        if (!$user) {
            return abort(404);
        }

        Follower::create([
            'user_id' => $id,
            'follower_id' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ])->save();

        return redirect("users/{$id}");
    }

    public function unfollow($id)
    {
        $user = User::find($id);
        if (!$user) {
            return abort(404);
        }

        $followRelation = DB::table('followers')
            ->where('user_id', $id)
            ->where('follower_id', auth()->user()->id);

        $followRelation->delete();

        return redirect("users/{$id}");
    }
}
