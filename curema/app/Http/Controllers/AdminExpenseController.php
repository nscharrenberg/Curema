<?php

namespace App\Http\Controllers;

use App\Client;
use App\Currency;
use App\Expense;
use App\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminExpenseController extends Controller
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
        $expenses = Expense::all();
        return view('admin.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('company', 'id')->prepend('Select A Client', '')->all();
        $currencies = Currency::pluck('name', 'id')->prepend('Select A Currency', '')->all();
        $categories = ExpenseCategory::pluck('name', 'id')->prepend('Select a Category', '')->all();
        return view('admin.expenses.create', compact('clients', 'currencies', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense = Expense::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'note' => $request->note,
            'number' => $request->number,
            'prefix' => "EXP-",
            'amount' => $request->amount,
            'tax_percentage' => $request->tax_percentage,
            'currency_id' => $request->currency_id,
            'client_id' => $request->client_id ? $request->client_id : null,
            'invoice_id' => $request->client_id && $request->invoice_id ? $request->invoice_id : null,
            'date' => Carbon::createFromFormat("Y/m/d", $request->date),
        ]);

        Session::flash('created_expense', 'The expense with Reference Nr: ' . $expense->prefix . ' ' . $expense->number . ' has been created!');
        return redirect('/admin/expenses');
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
        $expense = Expense::findOrFail($id);
        $clients = Client::pluck('company', 'id')->prepend('Select A Client', '')->all();
        $currencies = Currency::pluck('name', 'id')->prepend('Select A Currency', '')->all();
        $categories = ExpenseCategory::pluck('name', 'id')->prepend('Select a Category', '')->all();
        return view('admin.expenses.edit', compact('clients', 'currencies', 'categories', 'expense'));
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
        $expense = Expense::findOrFail($id);
        $expense->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'note' => $request->note,
            'number' => $expense->number,
            'prefix' => $expense->prefix,
            'amount' => $request->amount,
            'tax_percentage' => $request->tax_percentage,
            'currency_id' => $request->currency_id,
            'client_id' => $request->client_id ? $request->client_id : null,
            'invoice_id' => $request->client_id && $request->invoice_id ? $request->invoice_id : null,
            'date' => Carbon::createFromFormat("Y/m/d", $request->date),
        ]);

        Session::flash('updated_expense', 'The expense with Reference Nr: ' . $expense->prefix . ' ' . $expense->number . ' has been updated!');
        return redirect('/admin/expenses');
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
