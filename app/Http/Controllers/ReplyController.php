<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReplyController extends Controller
{

    public function addReply(Request $request, $commentId)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);


        $comment = DB::table('comments')->where('id', $commentId)->first();
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }


        $replyId = DB::table('replies')->insertGetId([
            'comment_id' => $commentId,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['id' => $replyId, 'message' => 'Reply added successfully']);
    }

    public function deleteReply($replyId)
    {
        // return $replyId;
        $reply = DB::table('replies')
            ->where('id', $replyId)
            ->first();

        if (!$reply) {
            return response()->json([
                'message' => 'Reply not found or you are not authorized to delete this reply',
                'status' => 'error'
            ], 404);
        }


        DB::table('replies')->where('id', $replyId)->delete();

        return response()->json([
            'message' => 'Reply deleted successfully',
            'status' => 'success'
        ], 200);
    }


    public function updateReply(Request $request, $replyId)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        $reply = DB::table('replies')->where('id', $replyId)->first();
        if (!$reply) {
            return response()->json(['message' => 'Reply not found or you are not authorized to edit this reply'], 404);
        }


        DB::table('replies')
            ->where('id', $replyId)
            ->update([
                'content' => $validated['content'],
                'updated_at' => now(),
            ]);

        return response()->json(['message' => 'Reply updated successfully']);
    }
}
