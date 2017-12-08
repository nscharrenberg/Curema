<?php

namespace App\Http\Controllers;

use App\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminTicketCommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = TicketComment::create([
            'user_id' => auth()->user()->id,
            'ticket_id' => $request->ticket_id,
            'content' => $request->content_body
        ]);

        Session::flash('created_comment', 'Your comment has been placed.');
        return redirect('/admin/tickets/' . $comment->ticket_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
