<?php

namespace App\Http\Controllers\Addons;

use App\Addons\UwvContact;
use App\Http\Requests\Addons\UwvContactRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminUwvContactController extends Controller
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
        $contacts = UwvContact::all();
        return view('admin.uwv.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.uwv.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UwvContactRequest $request)
    {
        $input = $request->all();
        $contact = UwvContact::create($input);
        Session::flash('created_uwv_contact', 'The UWV Contact ' . $contact->firstname . ' ' . $contact->lastname . ' has been created');
        return redirect('/admin/uwv/contacts');
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
        $contact = UwvContact::findOrFail($id);
        return view('admin.uwv.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UwvContactRequest $request, $id)
    {
        $input = $request->all();
        $contact = UwvContact::findOrFail($id);
        $contact->update($input);
        Session::flash('updated_uwv_contact', 'The UWV Contact ' . $contact->firstname . ' ' . $contact->lastname .  ' has been updated');
        return redirect('/admin/uwv/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = UwvContact::findOrFail($id);
        $contact->delete();
        Session::flash('deleted_uwv_contact', 'The UWV Contact ' . $contact->firstname . ' ' . $contact->lastname . ' has been deleted!');
        return redirect('/admin/uwv/contacts');
    }
}
