<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\Http\Requests\ExpenseCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminExpenseCategoryController extends Controller
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
        $categories = ExpenseCategory::all();
        return view('admin.expenses.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expenses.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseCategoryRequest $request)
    {
        $input = $request->all();
        $category = ExpenseCategory::create($input);
        Session::flash('created_expense_category', 'The Expense Category ' . $category->name  . ' has been created');
        return redirect('/admin/expenses/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = ExpenseCategory::findOrFail($id);
        return view('admin.expenses.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ExpenseCategory::findOrFail($id);
        return view('admin.expenses.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseCategoryRequest $request, $id)
    {
        $input = $request->all();
        $category = ExpenseCategory::findOrFail($id);
        $category->update($input);
        Session::flash('updated_expense_category', 'The Expense Category ' . $category->name  . ' has been updated');
        return redirect('/admin/expenses/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ExpenseCategory::findOrFail($id);
        $category->delete();
        Session::flash('deleted_expense_category', ' has been deleted!');
        return redirect('/admin/expenses/categories');
    }
}
