<?php

namespace App\Http\Controllers\Addons;

use App\Addons\UwvService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminUwvServiceController extends Controller
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
        $services = UwvService::all();
        return view('admin.uwv.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.uwv.services.create');
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
        $service = UwvService::create($input);
        Session::flash('created_uwv_service', 'The Service ' . $service->name . ' has been created');
        return redirect('/admin/uwv/services');
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
        $service = UwvService::findOrFail($id);
        return view('admin.uwv.services.edit', compact('service'));
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
        $service = UwvService::findOrFail($id);
        $service->update($input);
        Session::flash('updated_uwv_service', 'The UWV Service ' . $service->name .  ' has been updated');
        return redirect('/admin/uwv/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = UwvService::findOrFail($id);
        $service->delete();
        Session::flash('deleted_uwv_service', 'The UWV Service ' . $service->name . ' has been deleted!');
        return redirect('/admin/uwv/services');
    }
}
