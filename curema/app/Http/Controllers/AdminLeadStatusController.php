<?php

namespace App\Http\Controllers;

use App\Admin;
use App\LeadSource;
use App\LeadStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminLeadStatusController extends Controller
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
        $statusses = LeadStatus::orderBy('order', 'ASC')->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.leads.status.index', compact('statusses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.leads.status.create');
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
            'color_code' => 'required',
            'order' => 'required|numeric'
        ]);

        $input = $request->all();
        $status = LeadStatus::create($input);
        Session::flash('created_leadStatus', 'The Lead Status ' . $status->name . ' has been created');
        return redirect('/admin/leads/status');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = LeadStatus::findOrFail($id);
        return view('admin.leads.status.edit', compact('status'));
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
            'color_code' => 'required',
            'order' => 'required|numeric'
        ]);

        $status = LeadStatus::findOrFail($id);
        $status->name = $request->name;
        $status->color_code = $request->color_code;
        $status->order = $request->order;
        $status->default = $request->default;
        $status->save();
        Session::flash('updated_leadStatus', 'The Lead Status ' . $status->name . ' has been updated');
        return redirect('/admin/leads/status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = LeadStatus::findOrFail($id);
        $status->delete();
        Session::flash('deleted_leadStatus', 'The Lead Status ' . $status->name . ' has been deleted');
        return redirect('/admin/leads/status');
    }
}
