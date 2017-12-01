<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminDepartment;
use App\Country;
use App\Department;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminEmployeeController extends Controller
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
        $employees = Admin::where('admin', '0')->where('agent', '0')->paginate(10);
        $admins = Admin::where('admin', '1')->paginate(10);
        $agents = Admin::where('agent', '1')->paginate(10);
        return view('admin.employees.index', compact('employees', 'admins', 'agents'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all()->pluck('name', 'id');
        $countries = Country::pluck('name', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();
        return view('admin.employees.create', compact('departments', 'countries', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = Admin::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phonenumber' => $request->phonenumber,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'admin' => $request->admin,
            'default_language' => $request->default_language,
            'active' => $request->active,
            'agent' => $request->agent,
            'hourly_rate' => $request->hourly_rate,
            'email_signature' => $request->email_signature
        ]);

        foreach($request->departments as $department) {
            AdminDepartment::create([
               'department_id' => $department,
               'admin_id' => $employee->id
            ]);
        }

        Session::flash('created_employee', 'The Employee ' . $employee->fullname . ' has been created');
        return redirect('/admin/employees');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Admin::findOrFail($id);
        $departments = Department::all()->pluck('name', 'id');
        $countries = Country::pluck('name', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();
        $employeeDepartments = $employee->departments;
        return view('admin.employees.edit', compact('employee', 'departments', 'countries', 'languages', 'employeeDepartments'));
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
        //
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
