<?php

namespace App\Http\Controllers;

use App\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientContractController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Auth::user()->client->contracts;
        return view('client.contracts.index', compact('contracts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::findOrfail($id);
        $today = Carbon::now('Europe/Amsterdam');
        if($contract->client != Auth::user()->client) {
            return abort(404);
        } else {
            return view('client.contracts.show', compact('contract', 'today'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);
        $contract->accepted = true;
        $contract->response_date = Carbon::now('Europe/Amsterdam');
        $contract->update();

        Session::flash('accepted_contract', 'The Contract has been accepted!');
        return redirect('/contracts/' . $contract->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);
        $contract->accepted = false;
        $contract->response_date = Carbon::now('Europe/Amsterdam');
        $contract->update();

        Session::flash('declined_contract', 'The Contract has been declined!');
        return redirect('/contracts/' . $contract->id);
    }
}
