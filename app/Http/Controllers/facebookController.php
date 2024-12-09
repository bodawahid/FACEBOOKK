<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class facebookController extends Controller
{
    public function home()
    {
        return view('facebook');
    }
    public function getData()
    {
        // get user information .
        // $user = Auth::user();
        // getting latest posts ,
        $posts = DB::select('select p.id post_id , p.content post_content , p.created_at , p.updated_at , pm.id pm_id, pm.media_path media_path ,
        pm.media_type, users.name ,  profiles.profile_picture , pm2.media_path SharedPostMediaPath , pm2.media_type 				SharedPostMediaType, prof1.profile_picture SharedPostUserProfilePicture , p.post_id SharedPostId ,
        users.id user_id , p1.content , p1.content SharedPostContent , P1.created_at SharedPostCreatedAt,
        p1.deleted_at SharedPostDeletedAt , u1.name SharedPostUserName , u1.id 	SharedPostUserId
        from posts p left join posts_media pm on p.id = pm.post_id
        left join users on users.id = p.user_id left join profiles on users.id = profiles.user_id
        Left join posts p1 on p1.id = p.post_id LEFT JOIN users u1 on p1.user_id = u1.id
        LEFT join posts_media pm2 on p1.id = pm2.post_id LEFT JOIN profiles prof1 on u1.id = prof1.user_id
        where p.deleted_at is null order by p.id desc limit 20');
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
                        'updated_at' => $post->updated_at,
                        'SharedPostId' => $post->SharedPostId,

                    ],
                    'postMedia' => [],
                ];
                if ($post->SharedPostId) {
                    $structuredPosts[$index]['SharedPost']
                        = [
                            'content' => $post->SharedPostContent,
                            'created_at' => $post->SharedPostCreatedAt,
                            'deleted_at' => $post->SharedPostDeletedAt,
                            'user_name' => $post->SharedPostUserName,
                            'user_id' => $post->SharedPostUserId,
                            'profile_picture' => $post->SharedPostUserProfilePicture,
                            'SharedPostMedia'=>[]
                        ];
                }
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
            if ($post->SharedPostMediaType) {
                $structuredPosts[$index - 1]['SharedPost']['SharedPostMedia'][] =
                    [
                        'SharedPostMediaType' => $post->SharedPostMediaType,
                        'SharedPostMediaPath' => $post->SharedPostMediaPath,
                    ];
            }
        }
        return response()->json(['posts' => $structuredPosts]);
    }
}
