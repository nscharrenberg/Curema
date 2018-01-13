<?php

namespace App\Http\Controllers;

use App\ContractType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminContractTypeController extends Controller
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
        $types = ContractType::all();
        return view('admin.contracts.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contracts.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contractType = ContractType::create([
            'name' => $request->name
        ]);

        Session::flash('created_contract_type', 'The contract type ' . $contractType->name . ' has been created');
        return redirect('/admin/contracts/types');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = ContractType::findOrFail($id);
        return view('admin.contracts.types.edit', compact('type'));
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
        $contractType = ContractType::findOrFail($id);
        $contractType->update([
            'name' => $request->name,
        ]);

        Session::flash('updated_contract_type', 'The contract type' . $contractType->name . ' has been updated');
        return redirect('/admin/contracts/types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contractType = ContractType::findOrFail($id);
        $contractType->delete();
        Session::flash('deleted_contract_type', 'The contracty type '  . $contractType->name . ' has been deleted');
        return redirect('/admin/contracts/types');
    }
}
