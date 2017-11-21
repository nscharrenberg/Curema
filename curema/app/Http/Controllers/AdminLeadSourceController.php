<?php

namespace App\Http\Controllers;

use App\LeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminLeadSourceController extends Controller
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
        $sources = LeadSource::all();
        return view('admin.leads.sources.index', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.leads.sources.create');
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
        $source = LeadSource::create($input);
        Session::flash('created_leadSource', 'The Lead Source ' . $source->name . ' has been created');
        return redirect('/admin/leads/sources');
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
        $source = LeadSource::findOrFail($id);
        return view('admin.leads.sources.edit', compact('source'));
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
        $source = LeadSource::findOrFail($id);
        $source->name = $request->name;
        $source->save();
        Session::flash('updated_leadSource', 'The Lead Source ' . $source->name . ' has been updated');
        return redirect('/admin/leads/sources');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $source = LeadSource::findOrFail($id);
        $source->delete();
        Session::flash('deleted_leadSource', 'The Lead Source ' . $source->name . ' has been deleted');
        return redirect('/admin/leads/sources');
    }
}
