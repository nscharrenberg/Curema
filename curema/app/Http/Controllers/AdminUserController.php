<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\UserCreateRequest;
use App\Language;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($clientid)
    {
        $client = Client::findOrFail($clientid);
        $languages = Language::pluck('name', 'id')->all();
        return view('admin.clients.contacts.create', compact('client', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserCreateRequest $request)
    {
        $client = Client::findOrFail($request->client_id);
        /**
         * Create a new Contact User for a Client
         */
        $user = User::create([
            'client_id' => $request->client_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phonenumber' => $request->phonenumber,
            'default_language' => $request->default_language,
            'active' => $request->active
        ]);

        /**
         * Set the newly created user as Primary contact for the client, if is_primary is checked.
         */
        if($request->is_primary) {
            $client->primary_contact_id = $user->id;
            $client->save();
        }

        Session::flash('created_contact', 'A new Contact named "' . $user->firstname . ' ' . $user->lastname . '" has been created for the client: ' . $client->company . '!');
        return redirect('/admin/customer/' . $request->client_id . '/contact/show');
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($client, $id)
    {
       $contact = User::findOrFail($id);
       $languages = Language::pluck('name', 'id')->all();
       return view('admin.clients.contacts.edit', compact('contact', 'languages'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $clientid
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $clientid, $id)
    {
        $client = Client::findOrFail($clientid);
        $contact = User::findOrFail($id);

        // Modify Contact Information
        $contact->firstname = $request->firstname;
        $contact->lastname = $request->lastname;
        $contact->email = $request->email;
        $contact->phonenumber = $request->phonenumber;
        $contact->default_language = $request->default_language;
        $contact->active = $request->active;

        if ($request->password) {
            $contact->password = bcrypt($request->password);
        }
        $contact->save();

        /**
         * Set the newly created user as Primary contact for the client, if is_primary is checked.
         */
        if($request->is_primary) {
            $client->primary_contact_id = $contact->id;
            $client->save();
        }

        Session::flash('updated_contact', 'The Contact: ' . $contact->firstname . ' ' . $contact->lastname . ' has been changed!');
        return redirect('/admin/customer/' . $clientid . '/contact/show');
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
