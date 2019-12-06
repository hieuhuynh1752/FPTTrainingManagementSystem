<?php

namespace App\Http\Controllers;

use App\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseCategoryController extends Controller
{
    public function index(){
        //$courses = Course::with('coursecategories')->get();
        //$courses = DB::table('courses')->orderBy('id')->get();
        $categories = DB::table('course_categories')->orderBy('id')->get();
        return view('trainingstaff.coursecategory.index')->with(['categories'=>$categories]);
    }

    public function create(){

        //$categories = DB::table('course_categories')->orderBy('id')->get();

        return view('trainingstaff.coursecategory.create');
    }

    public function store(Request $request)
    {
        //Persist the employee in the database
        //form data is available in the request object
        $category = new CourseCategory();
        //input method is used to get the value of input with its
        //name specified
        $category->CourseCategoryName =$request->input('name');
        $category->CourseCategoryDescription = $request->input('description');


        $category->save(); //persist the data
        return redirect()->route('coursecategory.index')->with('info', 'Course Category Added Successfully');
    }

    public function edit($id)
    {
        $category = DB::table('course_categories')->where('id',$id)->first();
        //$categories = DB::table('course_categories')->orderBy('id')->get();
        return view('trainingstaff.coursecategory.edit',['category'=>$category]);
    }

    public function update(Request $request)
    {
        //Retrieve the employee and update
        $category = CourseCategory::findOrFail($request->input('id'));
        //$course = Course::where('CourseID', $request->input('id'))->first();
        $category->CourseCategoryName = $request->input('name');

        $category->CourseCategoryDescription = $request->input('description');

        $category->save(); //persist the data
        return redirect()->route('coursecategory.index')->with('info','Course Category Updated Successfully');
    }

    public function search(Request $request){
        $search =$request->get('search');
        $categories = DB::table('course_categories')->where('CourseCategoryName','like','%'.$search.'%')->get();
        //$categories = DB::table('course_categories')->orderBy('id')->get();
        return view('trainingstaff.coursecategory.index',['categories'=>$categories]);
    }

    public function destroy($id)
    {
        $category = CourseCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('coursecategory.index');
    }
}
