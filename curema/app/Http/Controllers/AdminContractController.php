<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Client;
use App\Contract;
use App\ContractType;
use App\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminContractController extends Controller
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
        $contracts = Contract::all();
        return view('admin.contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::pluck('name', 'id')->prepend('Select A Currency', '')->all();
        $types = ContractType::pluck('name', 'id')->prepend('Select a Contract Type', '')->all();
        $clients = Client::pluck('company', 'id')->all();
        return view('admin.contracts.create', compact( 'currencies', 'types', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contract = Contract::create([
            'type_id' => $request->type_id,
            'subject' => $request->subject,
            'description' => $request->description != null ? $request->description : null,
            'content' => $request->content_body != null ? $request->content_body : null,
            'client_id' => $request->client_id,
            'start_date' => Carbon::createFromFormat("Y/m/d", $request->start_date),
            'end_date' => Carbon::createFromFormat("Y/m/d", $request->end_date),
            'sales_agent' => auth()->user()->id,
            'currency_id' => $request->currency_id,
            'value' => $request->value,
            'showToClient' => $request->showToClient ? true : false,
        ]);

        Session::flash('created_contract', 'The contract ' . $contract->subject . ' has been created');
        return redirect('/admin/contracts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        $currencies = Currency::pluck('name', 'id')->prepend('Select A Currency', '')->all();
        $types = ContractType::pluck('name', 'id')->prepend('Select a Contract Type', '')->all();
        $clients = Client::pluck('company', 'id')->all();
        return view('admin.contracts.edit', compact('contract', 'currencies', 'types', 'clients'));
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
        $contract = Contract::findOrFail($id);
        $contract->update([
            'type_id' => $request->type_id,
            'subject' => $request->subject,
            'description' => $request->description != null ? $request->description : null,
            'content' => $request->content_body != null ? $request->content_body : null,
            'client_id' => $request->client_id,
            'start_date' => Carbon::createFromFormat("Y/m/d", $request->start_date),
            'end_date' => Carbon::createFromFormat("Y/m/d", $request->end_date),
            'currency_id' => $request->currency_id,
            'value' => $request->value,
            'showToClient' => $request->showToClient ? true : false,
        ]);

        Session::flash('updated_contract', 'The contract ' . $contract->subject . ' has been updated');
        return redirect('/admin/contracts');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::findOrFail($id);
        return view('admin.contracts.show', compact('contract'));
    }
}
