<?php

namespace App\Http\Controllers;

use App\Client;
use App\Country;
use App\Currency;
use App\Http\Requests\ClientCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminClientController extends Controller
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
        $clients = Client::all();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id')->all();
        $currencies = Currency::pluck('name', 'id')->all();
        return view('admin.clients.create', compact('countries', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateRequest $request)
    {
        $input = $request->all();
        $client = Client::create($input);
        Session::flash('created_client', 'The client: ' . $client->company . ' has been created!');
        return redirect('/admin/customer');
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
        $contacts = $client->users()->get();
        return view('admin.clients.contacts.show', compact('client', 'contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $countries = Country::pluck('name', 'id')->all();
        $currencies = Currency::pluck('name', 'id')->all();
        return view('admin.clients.edit', compact('client', 'countries', 'currencies'));
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
       $client = Client::findOrFail($id);
       $client->update($input);
       Session::flash('updated_client', 'The client: ' . $client->company . ' has been changed!');
       return redirect('/admin/customer');
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
