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

        if($request->agents) {
            foreach ($request->agents as $agent) {
                if ($agent != null) {
                    AdminDepartment::create([
                        'department_id' => $department->id,
                        'admin_id' => $agent->id
                    ]);
                }
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
        $agents = Admin::where('agent', '1')->get(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select An Agent to this Department', '');
        $employeeDepartments = $department->agents;
        return view('admin.departments.edit', compact('department', 'agents', 'employeeDepartments'));
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
        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->color_code = $request->color_code;
        $department->update();

        if($request->agents) {
            foreach (Admin::all() as $agent) {
                /*
                 * Find the Admin Id value from the $request->agents array, which will return the key for the $requests->agents array.
                 * It then iterates through the $requests->agents id per key and compares it's value with the admin Id it is currently at.
                 * If it's found it'll search wether it exists already and else it'll create one.
                 * If it's not found it'll search wether it exists and if it does, it'll delete it from the database.
                 */
                if ($agent->id == $request->agents[array_search($agent->id, $request->agents)]) {
                    // Add or do not
                    AdminDepartment::firstOrcreate([
                        'admin_id' => $agent->id,
                        'department_id' => $department->id
                    ]);
                } else {
                    AdminDepartment::whereDepartmentId($department->id)->whereAdminId($agent->id)->delete();
                }
            }
        } else {
            AdminDepartment::whereDepartmentId($department->id)->delete();
        }

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
