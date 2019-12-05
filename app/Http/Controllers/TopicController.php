<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function index(){
        //$courses = Course::with('coursecategories')->get();
        $topics = DB::table('topics')->orderBy('id')->get();
        $trainers = DB::table('trainers')->orderBy('id')->get();
        foreach ($topics as $topic){
            foreach ($trainers as $trainer){
                if($topic->TrainerID==$trainer->id){
                    $topic->TrainerName=$trainer->TrainerName;
                }
            }
        }
        return view('trainingstaff.topic.index')->with(['topics'=>$topics]);
    }

    public function create(){

        $trainers = DB::table('trainers')->orderBy('id')->get();

        return view('trainingstaff.topic.create')->with([
            'trainers'=>$trainers
        ]);
    }

    public function store(Request $request)
    {
        //Persist the employee in the database
        //form data is available in the request object
        $topic = new Topic();
        //input method is used to get the value of input with its
        //name specified
        $topic->TrainerID =$request->input('trainer');
        $topic->TopicName = $request->input('name');
        $topic->TopicDescription = $request->input('description');


        $topic->save(); //persist the data
        return redirect()->route('topic.index')->with('info', 'Topic Added Successfully');
    }

    public function edit($id)
    {
        $topic = DB::table('topics')->where('id',$id)->first();
        $trainers = DB::table('trainers')->orderBy('id')->get();
        return view('trainingstaff.topic.edit',['topic'=>$topic,'trainers'=>$trainers]);
    }

    public function update(Request $request)
    {
        //Retrieve the employee and update
        $topic = Topic::findOrFail($request->input('id'));
        //$course = Course::where('CourseID', $request->input('id'))->first();
        $topic->TrainerID = $request->input('trainer');
        $topic->TopicName = $request->input('name');
        $topic->TopicDescription = $request->input('description');

        $topic->save(); //persist the data
        return redirect()->route('topic.index')->with('info','Topic Updated Successfully');
    }

    public function search(Request $request){
        $search =$request->get('search');
        $topics = DB::table('topics')->where('TopicName','like','%'.$search.'%')->get();
        $trainers = DB::table('trainers')->orderBy('id')->get();
        foreach ($topics as $topic){
            foreach ($trainers as $trainer){
                if($topic->TrainerID==$trainer->id){
                    $topic->TopicName=$trainer->TrainerName;
                }
            }
        }

        return view('trainingstaff.topic.index',['topics'=>$topics]);
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return redirect()->route('topic.index');
    }
}
