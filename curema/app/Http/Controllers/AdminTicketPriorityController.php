<?php

namespace App\Http\Controllers;

use App\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminTicketPriorityController extends Controller
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
        $priorities = TicketPriority::all();
        return view('admin.tickets.priorities.index', compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tickets.priorities.create');
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
            'name' => 'required',
            'color_code' => 'required'
        ]);

        $input = $request->all();
        $priority = TicketPriority::create($input);
        Session::flash('created_ticket_priority', 'The Ticket Priority ' . $priority->name  . ' has been created');
        return redirect('/admin/tickets/priorities');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $priority = TicketPriority::findOrFail($id);
        return view('admin.tickets.priorities.edit', compact('priority'));
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
            'name' => 'required',
            'color_code' => 'required'
        ]);

        $input = $request->all();
        $priority = TicketPriority::findOrFail($id);
        $priority->update($input);
        Session::flash('updated_ticket_priority', 'The Ticket Priority ' . $priority->name . ' has been updated');
        return redirect('/admin/tickets/priorities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priority = TicketPriority::findOrFail($id);
        $priority->delete();
        Session::flash('deleted_ticket_priority', 'Ticket Priority has been deleted!');
        return redirect('/admin/tickets/priorities');
    }
}
