<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Department;
use App\User;

class LoggedAdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        return redirect()->route('admin.login');
    }

    public function showAddDepartment()
    {

        return view('admin.addDepartment');
    }

    public function postAddDepartment(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'faculty' => 'required',
        ]);
        $dept = new Department($request->all());
        $dept->save();
        $request->session()->flash('success', 'Department added successfully');
        return redirect()->back();
    }

    public function showAddStudent()
    {
        $departments = Department::all();

        return view('admin.addStudent', compact('departments'));
    }

    public function postAddStudent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'department' => 'required',
            'password' => 'required',
            'matric' => 'required|unique:users,matric',
        ]);

        $student = new User($request->all());
        $request->session()->flash('success', 'Student added to graduating list successfully');
        return redirect()->back();
    }
}
