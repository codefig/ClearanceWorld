<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Department;
use App\Material;
use App\Submission;
use App\User;
use Illuminate\Support\Facades\Hash;

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
        $student->matric = $request->matric;
        $student->department = $request->department;
        $student->email_verified_at = null;
        $student->password = Hash::make($request->password);
        $student->is_graduating = $request->is_graduating;
        $student->is_approved = 0;
        $student->is_serving = 0;
        $student->save();
        $request->session()->flash('success', 'Student record added successfully');
        return redirect()->back();
    }

    public function showAllStudents()
    {
        $students = User::all();
        return view('admin.allstudents', compact('students'));
    }

    public function showGraduatingList()
    {
        $students = User::where('is_graduating', '=', 1)->get();
        return view('admin.graduating', compact('students'));
    }

    public function showApproved()
    {
        return view('admin.showapproved');
    }

    public function showApplications()
    {
        $applications = Submission::all();

        return view('admin.applications', compact('applications'));
    }

    public function approveSubmission($id)
    {
        return "Approve submission " . $id;
    }

    public function addCourse()
    {
        return view('admin.addCourse');
    }

    public function postAddCourse(Request $request)
    {
        $author_id = Auth::id();
        $this->validate($request, [
            'title' => 'required|unique:courses,NULL,title,id,author_id,' . Auth::id(),
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_course' => 'required'
        ], [
            'title.unique' => 'Sorry, You created a course with this title already',
        ]);

        $banner = 'banner-' . time() . '.' . $request->banner->getClientOriginalExtension();
        request()->banner->move(public_path('uploads'), $banner);

        $course = new Course();
        $course->title = $request->title;
        $course->author_id = Auth::id();
        $course->about = $request->about_course;
        $course->banner = $banner;
        $course->save();
        $request->session()->flash('success', 'Course Created successfully!');
        return redirect()->back();
    }

    public function addContent()
    {
        $mycourses = Course::where('author_id', Auth::id())->get();
        return  view('admin.addContent', compact('mycourses'));
    }

    public function postAddContent(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'course_id' => "required|integer",
            'info' => 'required',
            'media' => 'required|mimes:jpeg,png,jpg,docx,pdf,mp4,zip|max:5096'
        ]);

        $material = new Material($request->all());
        $image = $request->file('media');
        $media_file = time() . "__" . $request->media->getClientOriginalName();
        $image->move(public_path('materials'), $media_file);
        $material->author_id = Auth::id();
        $material->media = $media_file;
        $material->save();
        $request->session()->flash('success', 'Material Added to course  successfully!');
        return redirect()->back();
    }

    public function myCourses()
    {
        $courses = Course::where('author_id', Auth::id())->get();
        return view('admin.mycourses', compact('courses'));
    }

    public function allCourses()
    {
        return view('admin.allCourses');
    }
}
