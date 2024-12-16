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
        $user = DB::select('select bio , country , cover_picture , users.created_at created_at_ ,email , users.id , name, profile_picture from users left join profiles on users.id = profiles.user_id where users.id = ?', [$userId]);
        return response()->json(['user' => $user]);
    }
    public function getUserPosts(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'numeric', 'exists:users,id']
        ]);
        $profile_user_data = DB::select('select user_id as userID , name , profile_picture , cover_picture , email , bio from users u join profiles p on u.id = p.user_id where u.id = ?', [$request->user_id]);
        // get user information .
        // $user = Auth::user();
        // getting latest posts ,
        $posts = DB::select('select p.id post_id , p.content post_content , p.created_at , p.updated_at , pm.id pm_id, pm.media_path media_path ,
            pm.media_type, users.name ,  profiles.profile_picture , pm2.media_path SharedPostMediaPath , pm2.media_type SharedPostMediaType,
            prof1.profile_picture SharedPostUserProfilePicture , p.post_id SharedPostId ,
            users.id user_id , p1.content , p1.content SharedPostContent , P1.created_at SharedPostCreatedAt,
            p1.deleted_at SharedPostDeletedAt , u1.name SharedPostUserName , u1.id 	SharedPostUserId
            from posts p left join posts_media pm on p.id = pm.post_id
            left join users on users.id = p.user_id left join profiles on users.id = profiles.user_id
            Left join posts p1 on p1.id = p.post_id LEFT JOIN users u1 on p1.user_id = u1.id
            LEFT join posts_media pm2 on p1.id = pm2.post_id LEFT JOIN profiles prof1 on u1.id = prof1.user_id
            where p.deleted_at is null and p.user_id = ? order by p.id desc', [$request->user_id]);
        // in orm $posts->with('post_media')->get() ;
        $structuredPosts = [];
        $index = 0;
        $temp = null;
        foreach ($posts as $post) {
            if ($temp != $post->post_id) {
                $is_reacted = DB::select("select count(*) is_reacted from reacts where post_id = ? and user_id = ?", [$post->post_id, Auth::id(),]);
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
                        'is_reacted' => $is_reacted,

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
                            'SharedPostMedia' => []
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
        $followerID = Auth::id();

        // checking if a relationship exists
        $exists = DB::select(
            'select count(*) is_following from following where follower_id = ? and following_id = ? limit 1',
            [$followerID, $request->user_id]
        );
        return response()->json(['profile_user_data' => $profile_user_data, 'posts' => $structuredPosts, 'is_following' => $exists]);
    }
    public function follow(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $followerID = Auth::id();

        $exists = DB::select(
            'select 1 from following where follower_id = ? and following_id = ? limit 1',
            [$followerID, $request->user_id]
        );

        if (!empty($exists)) {
            return response()->json(['message' => 'Already following'], 200);
        }

        DB::insert(
            'insert into following (following_id, follower_id ,followed_at) values (? , ? , ?)',
            [$request->user_id, $followerID, now()]
        );

        return response()->json(['message' => 'followed successfully']);
    }

    public function unfollow(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $followerID = Auth::id();

        DB::delete(
            'delete from following where follower_id = ? and following_id = ?',
            [$followerID, $request->user_id]
        );

        return response()->json(['message' => 'Unfollowed successfully']);
    }

    public function getFollowers(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $followers = DB::select(
            'select u.id, u.name
            from following f join users u on f.follower_id = u.id
            where f.following_id = ?',
            [$request->user_id]
        );

        return response()->json(['followers' => $followers]);
    }

    public function getFollowing(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $following = DB::select(
            'select u.id, u.name
            from following f join users u on f.following_id = u.id
            where f.follower_id = ?',
            [$request->user_id]
        );

        return response()->json(['following' => $following]);
    }
    // update profile
    public function updateProfile(Request $request)
    {
        // return $request->cover_image;
        $request->validate([
            'name' => ['string', 'max:255'],
            'profile_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'cover_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $userId = Auth::id();

        // Initialize variables for file paths
        // $profileImagePath = null;
        // $coverImagePath = null;
        $profile_image_name = null;
        $cover_image_name = null;
        // Handle Profile Image Upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $originalName = $file->getClientOriginalName();
            // $extension = $file->getClientOriginalExtension();
            $profile_image_name = time() . '_' .  $originalName;
            $file->storeAs('users/image', $profile_image_name,  ['disk' => 'public']);
        }

        // Handle Cover Image Upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $originalName = $file->getClientOriginalName();
            // $extension = $file->getClientOriginalExtension();
            $cover_image_name = time() . '_' .  $originalName;
            $file->storeAs('users/image', $cover_image_name,  ['disk' => 'public']);
        }

        // Update the name in the users table
        if ($request->name !== null) {
            DB::update(
                'update users set name = ?, updated_at = ? where id = ?',
                [$request->name, now(), $userId]
            );
        }
        if ($profile_image_name && $cover_image_name) {
            DB::update('update profiles set profile_picture = ? , cover_picture = ? where user_id = ? ', [$profile_image_name, $cover_image_name, Auth::id()]);
        } else if ($profile_image_name) {
            DB::update('update profiles set profile_picture = ? where user_id = ? ', [$profile_image_name, Auth::id()]);
        } else {
            DB::update('update profiles set cover_picture = ? where user_id = ? ', [$cover_image_name, Auth::id()]);
        }

        // Update the profile_picture and cover_picture in the profiles table

        return response()->json(['message' => 'Profile updated successfully']);
    }
}
