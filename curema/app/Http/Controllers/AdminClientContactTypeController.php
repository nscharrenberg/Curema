<?php

namespace App\Http\Controllers;

use App\ClientContactType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminClientContactTypeController extends Controller
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
        $types = ClientContactType::all();
        return view('admin.contacts.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contacts.types.create');
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
        $type = ClientContactType::create($input);
        Session::flash('created_contactType', 'The Contact Type ' . $type->name . ' has been created');
        return redirect('/admin/contact_types');
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
        $type = ClientContactType::findOrFail($id);
        return view('admin.contacts.types.edit', compact('type'));
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
        $type = ClientContactType::findOrFail($id);
        $type->update($input);
        Session::flash('updated_contactType', 'The Contact Type ' . $type->name . ' has been updated');
        return redirect('/admin/contact_types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = ClientContactType::findOrFail($id);
        $type->delete();
        Session::flash('deleted_contactType', 'The Contact Type ' . $type->name . ' has been deleted');
        return redirect('/admin/contact_types');
    }
}
