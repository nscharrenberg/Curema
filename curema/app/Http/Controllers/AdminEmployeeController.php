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

        if($request->departments) {
            foreach($request->departments as $department) {
                AdminDepartment::create([
                    'department_id' => $department,
                    'admin_id' => $employee->id
                ]);
            }
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
        $employee = Admin::findOrfail($id);
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->email = $request->email;
        $employee->phonenumber = $request->phonenumber;
        $employee->facebook = $request->facebook;
        $employee->linkedin = $request->linkedin;
        $employee->admin = $request->admin;
        $employee->default_language = $request->default_language;
        $employee->active = $request->active;
        $employee->agent = $request->agent;
        $employee->hourly_rate = $request->hourly_rate;
        $employee->email_signature = $request->email_signature;
        if ($request->password) {
            $employee->password = bcrypt($request->password);
        }
        $employee->update();

        if($request->departments) {
            foreach (Department::all() as $department) {
                /*
                 * Find the department Id value from the $request->departments array, which will return the key for the $requests->departments array.
                 * It then iterates through the $requests->departments id per key and compares it's value with the departments Id it is currently at.
                 * If it's found it'll search wether it exists already and else it'll create one.
                 * If it's not found it'll search wether it exists and if it does, it'll delete it from the database.
                 */
                if ($department->id == $request->departments[array_search($department->id, $request->departments)]) {
                    // Add or do not
                    AdminDepartment::firstOrcreate([
                        'department_id' => $department->id,
                        'admin_id' => $employee->id
                    ]);
                } else {
                    AdminDepartment::whereDepartmentId($department->id)->whereAdminId($employee->id)->delete();
                }
            }
        } else {
            AdminDepartment::whereAdminId($employee->id)->delete();
        }

        Session::flash('updated_employee', 'The Employee ' . $employee->fullname . ' has been updated');
        return redirect('/admin/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Admin::findOrFail($id);
        if(!$employee->active && !$employee->admin) {
            $employee->delete();

            Session::flash('deleted_employee', 'The Employee ' . $employee->firstname . ' ' . $employee->lastname . ' has been deleted!');
            return redirect('/admin/employees');
        } else if ($employee->admin) {
            Session::flash('admin_employee', 'The Employee ' . $employee->firstname . ' ' . $employee->lastname . ' is an Administrator and cannot be deleted!');
            return redirect('/admin/employees');
        } else {
            Session::flash('active_employee', 'The Employee ' . $employee->firstname . ' ' . $employee->lastname . ' is an active employee and cannot be deleted!');
            return redirect('/admin/employees');
        }


    }
}
