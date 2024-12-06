<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer', 'exists:posts,id'],
            'content' => ['required', 'string'],
        ]);
        $content = $request->content;
        DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
        $comment = DB::select('select * from users where active = ?', [1]);
        DB::update('update users set votes = 100 where name = ?', ['John']);
        DB::delete('delete users where name = ?', ['John']);

        return response()->json(['comment' => $comment]);
    }
}
