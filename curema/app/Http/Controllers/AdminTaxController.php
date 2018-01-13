<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminTaxController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $taxes = Tax::all();
        return view('admin.taxes.index', compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.taxes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric'
        ]);

        $input = $request->all();
        $tax = Tax::create($input);
        Session::flash('created_tax', 'The tax ' . $tax->name . ' - ' . $tax->rate . '% has been created');
        return redirect('/admin/taxes');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     */
    public function show($id)
    {
        //TODO: Implement Show method
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $tax = Tax::findOrFail($id);
        return view('admin.taxes.edit', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric'
        ]);

        $input = $request->all();
        $tax = Tax::findOrFail($id);
        $tax->update($input);
        Session::flash('updated_tax', 'The Tax ' . $tax->name . ' - ' . $tax->rate . '% has been updated');
        return redirect('/admin/taxes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $type = Tax::findOrFail($id);
        $type->delete();
        Session::flash('deleted_tax', 'Tax has been deleted!');
        return redirect('/admin/taxes');
    }
}
