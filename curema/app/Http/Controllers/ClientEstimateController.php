<?php

namespace App\Http\Controllers;

use App\Estimate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientEstimateController extends Controller
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
        $estimates = Auth::user()->client->estimates;
        return view('client.estimates.index', compact('estimates'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estimate = Estimate::findOrfail($id);
        $today = Carbon::now('Europe/Amsterdam');
        if($estimate->client != Auth::user()->client) {
            return abort(404);
        } else {
            return view('client.estimates.show', compact('estimate', 'today'));
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
        $estimate = Estimate::findOrFail($id);
        $estimate->accepted = true;
        $estimate->response_date = Carbon::now('Europe/Amsterdam');
        $estimate->update();

        Session::flash('accepted_estimate', 'The Estimate has been accepted!');
        return redirect('/estimates/' . $estimate->id);
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
        $estimate = Estimate::findOrFail($id);
        $estimate->accepted = false;
        $estimate->response_date = Carbon::now('Europe/Amsterdam');
        $estimate->update();

        Session::flash('declined_estimate', 'The Estimate has been declined! You can always Accept this Estimate as long as its within the deadline');
        return redirect('/estimates/' . $estimate->id);
    }
}
