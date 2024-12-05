<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userProfile()
    {
        return view('profile');
    }
    public function currentUserData()
    {
        $userId = Auth::id();
        $user = DB::select('select bio , country , cover_picture , users.created_at ,email , users.id , name, profile_picture from users left join profiles on users.id = profiles.user_id where users.id = ?', [$userId]);
        return response()->json(['user' => $user]);
    }
    public function getUserPosts(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'numeric', 'exists:users,id']
        ]);
        $profile_user_data = DB::select('select name , profile_picture , email , bio from users u join profiles p on u.id = p.user_id where u.id = ?', [$request->user_id]);
        $posts = DB::select('select p.id post_id , p.content post_content , p.created_at , p.updated_at , pm.id pm_id, pm.media_path media_path , pm.media_type, users.name ,profile_picture , users.id user_id from posts p left join posts_media pm on p.id = pm.post_id 
      left join users on users.id = p.user_id left join profiles on users.id = profiles.user_id where p.deleted_at is null where p.user_id = ? order by p.id desc limit 20', [$request->user_id]);
        // in orm $posts->with('post_media')->get() ;
        $structuredPosts = [];
        $index = 0;
        $temp = null;
        foreach ($posts as $post) {
            if ($temp != $post->post_id) {
                $number_of_comments = DB::select('select count(*) number_of_comments from comments where comments.post_id = ?', [$post->post_id]);
                $number_of_reacts = DB::select('select count(*) number_of_reacts from reacts where post_id = ?', [$post->post_id]);
                $structuredPosts[$index] = [
                    'post' => [
                        'id' => $post->post_id,
                        'content' => $post->post_content,
                        'created_at' => $post->created_at,
                        'user_name' => $post->name,
                        'user_id' => $post->user_id,
                        'profile_picture' => $post->profile_picture,
                        'number_of_comments' => $number_of_comments[0]->number_of_comments,
                        'number_of_reacts' => $number_of_reacts[0]->number_of_reacts,
                        'updated_at' => $post->updated_at
                    ],
                    'postMedia' => []
                ];
                $index++;
                $temp = $post->post_id;
            }

            // searching the media 
            if ($post->pm_id) {
                $structuredPosts[$index - 1]['postMedia'][] = [
                    'media_path' => $post->media_path,
                    'media_type' => $post->media_type,
                ];
            }
        }
        return response()->json(['profile_user_data' => $profile_user_data, 'posts' => $structuredPosts]);
    }
}
