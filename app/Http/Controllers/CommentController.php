<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Psy\Readline\Hoa\Console;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        // dump($request->all());
        $validated = $request->validate([
            'post_id' => ['required', 'numeric', 'exists:posts,id'],
            'content' => ['required', 'string'],
        ]);

        $commentId = DB::table('comments')->insertGetId([
            'post_id' => $validated['post_id'],
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['id' => $commentId, 'message' => 'Comment added successfully']);
    }
    public function deleteComment($commentId)
    {

        $comment = DB::table('comments')->where('id', $commentId)->where('user_id', Auth::id())->first();

        if (!$comment) {
            return response()->json(['message' => 'Comment not found or you are not authorized to delete this comment'], 404);
        }


        DB::table('comments')->where('id', $commentId)->delete();


        DB::table('replies')->where('comment_id', $commentId)->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
    public function updateComment(Request $request, $commentId)
    {

        $validated = $request->validate([
            'content' => 'required|string',
        ]);


        $comment = DB::table('comments')->where('id', $commentId)->where('user_id', Auth::id())->first();

        if (!$comment) {
            return response()->json(['message' => 'Comment not found or you are not authorized to edit this comment'], 404);
        }


        DB::table('comments')
            ->where('id', $commentId)
            ->update([
                'content' => $validated['content'],
                'updated_at' => now(),
            ]);

        return response()->json(['message' => 'Comment updated successfully'], 200);
    }

    public function getComments($postId)
    {
        $comments = DB::select("
            SELECT c.id, c.content, c.user_id , c.created_at, u.name AS user_name
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.post_id = ?
            ORDER BY c.created_at DESC
        ", [$postId]);

        foreach ($comments as $comment) {
            $comment->replies = DB::select("
                SELECT r.id, r.content, r.user_id ,  r.created_at, u.name AS user_name
                FROM replies r
                JOIN users u ON r.user_id = u.id
                WHERE r.comment_id = ?
                ORDER BY r.created_at ASC
            ", [$comment->id]);
        }

        return response()->json($comments);
    }
}
