<?php

namespace App\Http\Controllers;

use App\Department;
use App\Ticket;
use App\TicketComment;
use App\TicketPriority;
use App\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientTicketController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unsolvedTickets = Ticket::where('user_id', Auth::user()->id)->where('complete', 0)->get();
        $solvedTickets = Ticket::where('user_id', Auth::user()->id)->where('complete', 1)->get();

        return view('client.tickets.index', compact('unsolvedTickets', 'solvedTickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities = TicketPriority::pluck('name', 'id')->all();
        $categories = Department::pluck('name', 'id')->all();
        return view('client.tickets.create', compact('priorities', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required',
            'content_body' => 'required',
            'priority_id' => 'required',
            'category_id' => 'required',
        ]);

        $ticket = Ticket::create([
           'subject' => $request->subject,
            'content' => $request->content_body,
            'status_id' => '1',
            'priority_id' => $request->priority_id,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id
        ]);

        Session::flash('created_ticket', 'The Ticket ' . $ticket->subject . ' for the department ' . $ticket->category->name . ' has been send!');
        return redirect('/tickets');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request)
    {
        $comment = TicketComment::create([
            'user_id' => auth()->user()->id,
            'ticket_id' => $request->ticket_id,
            'content' => $request->content_body,
            'isAdmin' => false
        ]);

        Session::flash('created_comment', 'Your comment has been placed.');
        return redirect('/tickets/' . $comment->ticket_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $comments = $ticket->comments;
        return view('client.tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $priorities = TicketPriority::pluck('name', 'id')->all();
        $categories = Department::pluck('name', 'id')->all();
        $statuses = TicketStatus::pluck('name', 'id')->all();
        return view('client.tickets.edit', compact('ticket', 'priorities', 'categories', 'statuses'));
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
        $validatedData = $request->validate([
            'subject' => 'required',
            'content_body' => 'required',
            'priority_id' => 'required',
            'category_id' => 'required',
        ]);

        $ticket = Ticket::findorFail($id);
        $ticket->subject = $request->subject;
        $ticket->content = $request->content_body;
        $ticket->status_id = $request->status_id;
        $ticket->priority_id = $request->priority_id;
        $ticket->update();

        Session::flash('updated_ticket', 'The Ticket ' . $ticket->subject . ' for the department ' . $ticket->category->name . ' has been adjusted!');
        return redirect('/tickets');
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
