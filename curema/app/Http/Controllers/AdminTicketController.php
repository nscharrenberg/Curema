<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Ticket;
use App\TicketComment;
use App\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminTicketController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorities = TicketPriority::orderBy('rank', 'ASC')->get();
        $ticketsSection = null;
        if(Auth::user()->admin) {
            foreach($priorities as $priority) {
                $ticketsSection[] = Ticket::whereNotIn('status_id', [2])->where('priority_id', $priority->id)->where('agent_id', auth()->user()->id)->where('complete', false)->get();
            }
        } else {
            foreach($priorities as $priority) {
                $ticketsSection[] = Ticket::whereNotIn('status_id', [2])->where('priority_id', $priority->id)->where('agent_id', auth()->user()->id)->get();
            }
        }

        $unassignedTickets = Ticket::whereNotIn('status_id', [2])->where('agent_id', null)->get();
        $completedTickets = Ticket::where('agent_id', auth()->user()->id)->where('complete', true)->get();

        return view('admin.tickets.index', compact('ticketsSection', 'unassignedTickets', 'completedTickets', 'priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('admin.tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function status(Request $request, $id) {
        $ticket = Ticket::findOrFail($id);
        $ticket->complete = $request->complete == true ? 1 : 0;
        $ticket->update();
        $status = $ticket->complete == 1 ? "Completed" : "Unsolved";
        Session::flash('updated_completion', 'The Ticket has been set as ' . $status);
        return redirect('/admin/tickets/' . $ticket->id);
    }

    public function claim(Request $request, $id) {
        $ticket = Ticket::findOrFail($id);
        $ticket->agent_id = auth()->user()->id;
        $ticket->save();

        Session::flash('updated_claimed', 'The Ticket ' . $ticket->subject . ' from ' . $ticket->user->fullName . ' has been claimed by You!');
        return redirect('/admin/tickets/' . $ticket->id);
    }
}
