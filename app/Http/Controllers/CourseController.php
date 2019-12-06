<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(){
        //$courses = Course::with('coursecategories')->get();
        $courses = DB::table('courses')->orderBy('id')->get();
        $categories = DB::table('course_categories')->orderBy('id')->get();
        foreach ($courses as $course){
            foreach ($categories as $category){
                if($course->CourseCategoryID==$category->id){
                    $course->CourseCategoryName=$category->CourseCategoryName;
                }
            }
        }
        return view('trainingstaff.course.index')->with(['courses'=>$courses]);
    }

    public function create(){

        $categories = DB::table('course_categories')->orderBy('id')->get();

        return view('trainingstaff.course.create')->with([
            'categories'=>$categories
        ]);
    }

    public function store(Request $request)
    {
        //Persist the employee in the database
        //form data is available in the request object
        $course = new Course();
        //input method is used to get the value of input with its
        //name specified
        $course->CourseCategoryID =$request->input('category');
        $course->CourseName = $request->input('name');
        $course->CourseDescription = $request->input('description');


        $course->save(); //persist the data
        return redirect()->route('course.index')->with('info', 'Course Added Successfully');
    }

    public function edit($id)
    {
        $course = DB::table('courses')->where('id',$id)->first();
        $categories = DB::table('course_categories')->orderBy('id')->get();
        return view('trainingstaff.course.edit',['course'=>$course,'categories'=>$categories]);
    }

    public function update(Request $request)
    {
        //Retrieve the employee and update
        $course = Course::findOrFail($request->input('id'));
        //$course = Course::where('CourseID', $request->input('id'))->first();
        $course->CourseCategoryID = $request->input('category');
        $course->CourseName = $request->input('name');
        $course->CourseDescription = $request->input('description');

        $course->save(); //persist the data
        return redirect()->route('course.index')->with('info','Course Updated Successfully');
    }

    public function search(Request $request){
        $search =$request->get('search');
        $courses = DB::table('courses')->where('CourseName','like','%'.$search.'%')->get();
        $categories = DB::table('course_categories')->orderBy('id')->get();
        foreach ($courses as $course){
            foreach ($categories as $category){
                if($course->id==$category->id){
                    $course->CourseCategoryName=$category->CourseCategoryName;
                }
            }
        }
        return view('trainingstaff.course.index',['courses'=>$courses]);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('course.index');
    }


    public function detail($id){
        $courses = DB::table('courses')->where('id',$id)->get();
        $categories = DB::table('course_categories')->orderBy('id')->get();
        foreach ($courses as $course){
            foreach ($categories as $category){
                if($course->CourseCategoryID==$category->id){
                    $course->CourseCategoryName=$category->CourseCategoryName;
                }
            }
        }
        $topics = DB::table('course_details')->where('courseid',$id)->get();
        $temptopics = DB::table('topics')->orderBy('id')->get();
        foreach ($topics as $topic){
            foreach ($temptopics as $temptopic){
                if($topic->TopicID==$temptopic->id){
                    $topic->TrainerID=$temptopic->TrainerID;
                    $topic->TopicName=$temptopic->TopicName;
                    $topic->TopicDescription=$temptopic->TopicDescription;
                }
            }
        }

        $trainers = DB::table('trainers')->orderBy('id')->get();
        foreach ($topics as $topic){
            foreach ($trainers as $trainer){
                if($topic->TrainerID==$trainer->id){
                    $topic->TrainerName=$trainer->TrainerName;
                }
            }
        }

        return view('trainingstaff.course.detail',['courses' =>$courses,'topics'=>$topics]);
    }

    public function assign($id){
        $course = DB::table('courses')->where('id',$id)->first();
        $name = $course->CourseName;
        $topics = DB::table('course_details')
                    ->join('topics',function($join) use ($id) {
                        $join->on('topics.id','<>','course_details.TopicID')->where('course_details.CourseID','=',$id);
                    })->get();
        $trainers = DB::table('trainers')->orderBy('id')->get();
        foreach ($topics as $topic){
            foreach ($trainers as $trainer){
                if($topic->TrainerID==$trainer->id){
                    $topic->TrainerName=$trainer->TrainerName;
                }
            }
        }
        return view('trainingstaff.course.assign',['courseid'=>$id,'topics'=>$topics,'name'=>$name]);
    }

    public function topic(Request $request){
        $topiclist = $request->topic;
        foreach ($topiclist as $topicitem){
            $assign = new CourseDetail();
            $assign->CourseID =$request->input('id');
            $assign->TopicID = $topicitem;
            $assign->save();
        }
        //return view('trainingstaff.index');
        $this->detail($request->input('id'));
    }
}
