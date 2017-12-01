<?php

namespace App\Http\Controllers;

use App\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminTicketStatusController extends Controller
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
        $statuses = TicketStatus::all();
        return view('admin.tickets.statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tickets.statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $status = TicketStatus::create($input);
        Session::flash('created_ticket_status', 'The Ticket Status ' . $status->name  . ' has been created');
        return redirect('/admin/tickets/statuses');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = TicketStatus::findOrFail($id);
        return view('admin.tickets.statuses.edit', compact('status'));
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
        $input = $request->all();
        $status = TicketStatus::findOrFail($id);
        $status->update($input);
        Session::flash('updated_ticket_status', 'The Ticket Status ' . $status->name . ' has been updated');
        return redirect('/admin/tickets/statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = TicketStatus::findOrFail($id);
        $status->delete();
        Session::flash('deleted_ticket_status', 'Ticket Status has been deleted!');
        return redirect('/admin/tickets/statuses');
    }
}
