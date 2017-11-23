<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Country;
use App\Currency;
use App\Http\Requests\LeadCreateRequest;
use App\Language;
use App\Lead;
use App\LeadSource;
use App\LeadStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminLeadController extends Controller
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
        $leads = Lead::all();
        return view('admin.leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = Admin::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select A Sales Agent', '');
        $status = LeadStatus::pluck('name', 'id')->all();
        $sources = LeadSource::pluck('name', 'id')->all();
        $countries = Country::pluck('name', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();
        return view('admin.leads.create', compact('admins', 'status', 'sources', 'countries', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadCreateRequest $request)
    {
        $lead = Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'company' => $request->company,
            'description' => $request->description,
            'website' => $request->website,
            'phonenumber' => $request->phonenumber,
            'country_id' => $request->country_id,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'assigned_to' => $request->assigned_to,
            'added_by' => $request->added_by,
            'status_id' => $request->status_id,
            'source_id' => $request->source_id,
            'last_contact' => $request->contacted_today == true ? Carbon::now('Europe/London') : null,
            'public' => $request->public != null ? $request->public : 0,
            'default_language' => $request->default_language
        ]);

        Session::flash('created_lead', 'The Lead ' . $lead->name . ' has been created');
        return redirect('/admin/leads');
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
        $lead = Lead::findOrFail($id);
        $admins = Admin::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select A Sales Agent', '');
        $status = LeadStatus::pluck('name', 'id')->all();
        $sources = LeadSource::pluck('name', 'id')->all();
        $countries = Country::pluck('name', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();
        $today = Carbon::today();
        return view('admin.leads.edit', compact('lead', 'admins', 'status', 'sources', 'countries', 'languages', 'today'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LeadCreateRequest $request, $id)
    {
        $lead = Lead::findOrFail($id);
//        dd($lead, $request->all());
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->title = $request->title;
        $lead->company = $request->company;
        $lead->description = $request->description;
        $lead->website = $request->website;
        $lead->phonenumber = $request->phonenumber;
        $lead->country_id = $request->country_id;
        $lead->state = $request->state;
        $lead->city = $request->city;
        $lead->address = $request->address;
        $lead->zipcode = $request->zipcode;
        $lead->assigned_to = $request->assigned_to;
        $lead->last_status_change = $lead->status_id != $request->status_id ? Carbon::now('Europe/London') : $lead->last_status_change;
        $lead->status_id = $request->status_id;
        $lead->source_id = $request->source_id;
        $lead->last_contact = $request->contacted_today == true ? Carbon::now('Europe/London') : $lead->last_contact;
        $lead->public = $request->public != null ? $request->public : 0;
        $lead->default_language = $request->default_language;
        $lead->save();

        Session::flash('updated_lead', 'The Lead ' . $lead->name . ' has been updated');
        return redirect('/admin/leads');
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
