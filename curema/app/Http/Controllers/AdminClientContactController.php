<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientContact;
use App\ClientContactType;
use App\Http\Requests\ContactMomentCreateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminClientContactController extends Controller
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
        $contacts = ClientContact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $client = Client::findOrFail($id);
        $types = ClientContactType::pluck('name', 'id')->all();
        $contacts = $client->users->pluck('fullname', 'id');

        return view('admin.contacts.create', compact('client', 'contacts', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactMomentCreateRequest $request)
    {
        $client = Client::findOrFail($request->client_id);
        $input = $request->all();
        $clientContact = ClientContact::create([
            'client_id' => $request->client_id,
            'contact_id' => $request->contact_id,
            'date' => Carbon::createFromFormat("Y/m/d", $request->date),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'notes' => $request->notes,
            'staff_id' => $request->staff_id,
            'type_id' => $request->type_id
        ]);
        return redirect()->action('AdminClientContactController@show', ['id' => $request->client_id])->with('created_clientContact', 'The Contact Moment with ' . $client->company . ' at ' . $clientContact->date . '% has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        $contacts = $client->contact_moments;
        return view('admin.contacts.index', compact('contacts','client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($client_id, $id)
    {
        $contactMoment = ClientContact::findOrFail($id);
        $client = Client::findOrFail($contactMoment->client_id);
        $contacts = $client->users->pluck('fullname', 'id');
        $types = ClientContactType::pluck('name', 'id')->all();
        return view('admin.contacts.edit', compact('contactMoment', 'client', 'contacts', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactMomentCreateRequest $request, $client_id, $id)
    {
        $contactMoment = ClientContact::findOrFail($id);
        $client = Client::findOrFail($contactMoment->client_id);

        $contactMoment->contact_id = $request->contact_id;
        $contactMoment->date = Carbon::createFromFormat("Y/m/d", $request->date);
        $contactMoment->start_time = $request->start_time;
        $contactMoment->end_time = $request->end_time;
        $contactMoment->notes = $request->notes;
        $contactMoment->type_id = $request->type_id;
        $contactMoment->save();

        return redirect()->action('AdminClientContactController@show', ['id' => $request->client_id])->with('updated_clientContact', 'The Contact Moment with ' . $client->company . ' on ' . $contactMoment->date . '% has been updated');
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
