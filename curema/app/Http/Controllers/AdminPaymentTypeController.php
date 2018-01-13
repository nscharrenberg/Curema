<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentTypeCreateRequest;
use App\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPaymentTypeController extends Controller
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
        $types = PaymentType::all();
        return view('admin.payments.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentTypeCreateRequest $request)
    {
        $input = $request->all();
        $type = PaymentType::create($input);
        Session::flash('created_paymenttype', 'The payment type ' . $type->name . 'has been created');
        return redirect('/admin/paymenttypes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = PaymentType::findOrFail($id);
        return view('admin.payments.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentTypeCreateRequest $request, $id)
    {
        $input = $request->all();
        $type = PaymentType::findOrFail($id);
        $type->update($input);
        Session::flash('updated_paymenttype', 'The payment type ' . $type->name . 'has been updated');
        return redirect('/admin/paymenttypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
