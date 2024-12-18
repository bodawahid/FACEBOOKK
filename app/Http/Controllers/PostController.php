<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    // creating a post ...
    public function create(Request $request)
    {
        $request->validate([
            'content' => ['nullable', 'string'],
            'content_type' => ['nullable', 'string', Rule::in(['text', 'attachement'])],
            'media' => 'nullable|array',
            'media.*' => ['nullable', 'file', 'max:10000'],
        ]);
        $path = null;
        DB::insert('insert into posts (content, content_type, user_id, created_at) values (?, ? , ? , ?)', [$request->content, $request->content_type ?? 'text', Auth::id(), now()]);
        $postId = DB::getPdo()->lastInsertId();
        foreach ($request->media as $file) {
            // get the original name with the extension ;
            $originalName = $file->getClientOriginalName();
            // $extension = $file->getClientOriginalExtension();
            $uniqueFilename = time() . '_' .  $originalName;
            $file->storeAs('posts/media', $uniqueFilename,  ['disk' => 'public']);
            // orm is so much easier ...
            $content_type = $file->getClientMimeType();
            if (str_contains($content_type, 'image')) {
                $content_type = 'image';
            } else {
                $content_type = 'video';
            }
            DB::insert('insert into posts_media (post_id, media_path, media_type , uploaded_at) values (?, ?, ?, ?)', [$postId, $uniqueFilename, $content_type, now()]);
        }
        // selecting data
        return redirect()->route('get.data');
    }
    public function sharePost(Request $request)
    {
        $request->validate([
            'content' => ['nullable', 'string'],
            'post_id' => ['required', 'numeric', 'exists:posts,id'],
        ]);
        DB::insert('insert into posts (content,content_type, user_id , created_at,post_id) values(?,?,?,?,?)', [$request->content ?? null, 'text', Auth::id(), now(), $request->post_id]);
        return redirect()->route('get.data');
    }
    public function editPost(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer', 'exists:posts,id'],
            'content' => ['required', 'string'],
        ]);
        DB::update('update posts set content = ? , updated_at = ? where id = ?', [$request->content, now(), $request->post_id]);
        // $post = DB::select('select * from posts where id = ?', [$request->post_id]);
        return response()->json(['message' => 'post is updated successfully']);
    }
    public function softDelete(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer', 'exists:posts,id'],
        ]);
        DB::update('update posts set deleted_at = ? where id = ?', [now(), $request->post_id]);
        return response()->json(['message' => 'post is deleted successfully']);
    }
    public function permenantDeletepermenantDelete(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer', 'exists:posts,id'],
        ]);
        DB::delete('delete from posts where id = ?', [$request->post_id]);
        return response()->json(['message' => 'post is deleted successfully']);
    }
    public function addPostLikes(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer', 'exists:posts,id'],
        ]);
        DB::insert('insert into reacts (post_id, user_id) values (?, ?)', [$request->post_id, Auth::id()]);
        return response()->json(['message' => 'reacted successfully']);
    }
    public function removePostLikes(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer', 'exists:posts,id'],
        ]);
        DB::delete('delete from reacts where post_id = ? and user_id = ?', [$request->post_id, Auth::id()]);
        return response()->json(['message' => 'deleted react successfully']);
    }
    public function getReactsInfo(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer', 'exists:posts,id'],
        ]);
        $reactedUsers = DB::select('select u.id , u.name , p.profile_picture
        from reacts r join users u on r.user_id = u.id and r.post_id = ? left join profiles p on u.id = p.user_id ', [$request->post_id]);
        return response()->json($reactedUsers);
    }
    // public function getMoreData(Request $request)
    // {
    //     $request->validate([
    //         'posts_id' => ['nullable', 'array']
    //     ]);
    //         $posts = DB::select('select p.id post_id , p.content post_content , p.created_at , p.updated_at , pm.id pm_id, pm.media_path media_path ,
    //         pm.media_type, users.name ,  profiles.profile_picture , pm2.media_path SharedPostMediaPath , pm2.media_type
    //         SharedPostMediaType, prof1.profile_picture SharedPostUserProfilePicture , p.post_id SharedPostId ,
    //         users.id user_id , p1.content , p1.content SharedPostContent , P1.created_at SharedPostCreatedAt,
    //         p1.deleted_at SharedPostDeletedAt , u1.name SharedPostUserName , u1.id 	SharedPostUserId
    //         from posts p left join posts_media pm on p.id = pm.post_id
    //         left join users on users.id = p.user_id left join profiles on users.id = profiles.user_id
    //         Left join posts p1 on p1.id = p.post_id LEFT JOIN users u1 on p1.user_id = u1.id
    //         LEFT join posts_media pm2 on p1.id = pm2.post_id LEFT JOIN profiles prof1 on u1.id = prof1.user_id
    //         where p.deleted_at is null order by p.id desc');
    //     // in orm $posts->with('post_media')->get() ;
    //     $structuredPosts = [];
    //     $posts_id = [];
    //     $index = 0;
    //     $temp = -1;
    //     foreach ($posts as $post) {
    //         if ($temp != $post->post_id) {
    //             $posts_id[$index] = $post->post_id;
    //             $is_reacted = DB::select("select count(*) is_reacted from reacts where post_id = ? and user_id = ?", [$post->post_id, Auth::id(),]);
    //             $number_of_comments = DB::select('select count(*) number_of_comments from comments where comments.post_id = ?', [$post->post_id]);
    //             $number_of_replies = DB::select("select count(*) number_of_replies from replies where comment_id in (select id from comments where comments.post_id = ?)", [$post->post_id]);
    //             $number_of_reacts = DB::select('select count(*) number_of_reacts from reacts where post_id = ?', [$post->post_id]);
    //             $structuredPosts[$index] = [
    //                 'post' => [
    //                     'id' => $post->post_id,
    //                     'content' => $post->post_content,
    //                     'created_at' => $post->created_at,
    //                     'user_name' => $post->name,
    //                     'user_id' => $post->user_id,
    //                     'profile_picture' => $post->profile_picture,
    //                     'number_of_comments' => $number_of_comments[0]->number_of_comments + $number_of_replies[0]->number_of_replies,
    //                     'number_of_reacts' => $number_of_reacts[0]->number_of_reacts,
    //                     'updated_at' => $post->updated_at,
    //                     'SharedPostId' => $post->SharedPostId,
    //                     'is_reacted' => $is_reacted,

    //                 ],
    //                 'postMedia' => [],
    //             ];
    //             if ($post->SharedPostId) {
    //                 $structuredPosts[$index]['SharedPost']
    //                     = [
    //                         'content' => $post->SharedPostContent,
    //                         'created_at' => $post->SharedPostCreatedAt,
    //                         'deleted_at' => $post->SharedPostDeletedAt,
    //                         'user_name' => $post->SharedPostUserName,
    //                         'user_id' => $post->SharedPostUserId,
    //                         'profile_picture' => $post->SharedPostUserProfilePicture,
    //                         'SharedPostMedia' => []
    //                     ];
    //             }
    //             $index++;
    //             $temp = $post->post_id;
    //         }

    //         // searching the media
    //         if ($post->pm_id) {
    //             $structuredPosts[$index - 1]['postMedia'][] = [
    //                 'media_path' => $post->media_path,
    //                 'media_type' => $post->media_type,
    //             ];
    //         }
    //         if ($post->SharedPostMediaType) {
    //             $structuredPosts[$index - 1]['SharedPost']['SharedPostMedia'][] =
    //                 [
    //                     'SharedPostMediaType' => $post->SharedPostMediaType,
    //                     'SharedPostMediaPath' => $post->SharedPostMediaPath,
    //                 ];
    //         }
    //     }
    //     return response()->json(['posts' => $structuredPosts, 'posts_id' => $posts_id]);
    // }
}
