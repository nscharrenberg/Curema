<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminDepartment;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminDepartmentController extends Controller
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
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Admin::where('agent', '1')->get(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select An Agent to this Department', '');
        return view('admin.departments.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = Department::create([
            'name' => $request->name,
            'color_code' => $request->color_code
        ]);

        foreach ($request->agents as $agent) {
            if ($agent != null) {
                AdminDepartment::create([
                    'department_id' => $department->id,
                    'admin_id' => $agent->id
                ]);
            }
        }
        Session::flash('created_department', 'The department ' . $department->name . ' has been created');
        return redirect('/admin/departments');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
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
        $department = Department::findOrFail($id);
        $department->update($input);
        Session::flash('updated_department', 'The department ' . $department->name . ' has been updated');
        return redirect('/admin/departments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        Session::flash('deleted_department', 'The department '  . $department->name . ' has been deleted');
        return redirect('/admin/departments');
    }
}
