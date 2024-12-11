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
}
