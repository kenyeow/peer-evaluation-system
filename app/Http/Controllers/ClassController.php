<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Assignment;
use Notification;

class ClassController extends Controller
{
    
    function student_dashboard()
    {  
        $student_class=null;
        $id = Auth::user()->id; 
        $class_code = Auth::user()->class_code;
        $class_data = DB::table('classes')->get();

        if($class_code!=null){
            foreach ($class_data as $i){
                foreach ($class_code as $j){
                    if ($i->class_code == $j){
                        if($student_class==null){
                            $student_class=array($i); 
                        }else{
                            array_push($student_class, $i);
                        }
                    }
                }
            }
        }
        
        return view('/student',['student_class'=> $student_class]);
    }

    function add_class(Request $req)
    {
        $id = Auth::user()->id; 
        $code = Auth::user()->class_code;
        $data = Student::find($id);

        $checkcode=DB::table('classes')->pluck('class_code');

        //check whether the class code have been added before
        if($data->class_code != null){
            foreach($data->class_code as $i){
                if($i == $req->class_code){
                    return redirect()->back()->withError('The Class Have Already Been Added!');
                }
            }
        }

        //loop the class code in class database to check whether the class code is valid and add class
        foreach ($checkcode as $c){
            
            if ($req->class_code==$c){
                if ($code==null){
                    $data->class_code=array($req->class_code);   
                }else{
                    array_push($code, $req->class_code);
                    $data->class_code=$code;
                }
                $data->save();
                return redirect()->back()->withSuccess('Class Successfully Added!');

            }
        }
        return redirect()->back()->withError('Class Code Invalid!');
    }

    function create_class(request $req)
    {
        $id = Auth::user()->id;
        $classjoincode = mt_rand(100000,999999);

        Classes::create([

            'lecturer_id'=> $id,
            'class_code' => $req->class_code,
            'class_name' => $req->class_name,
            'lecturer_name' =>Auth::user()->name,
            'class_join_code' =>$classjoincode,
            
           
        ]);
        return redirect()->back()->withSuccess('Class Successfully Created!');
    }

    function view_class()
    {
        $id = Auth::user()->id;

        $class_data = DB::table('classes')->get();
        $class_list= null;

        foreach ($class_data as $i){
            
            if ($i->lecturer_id == $id){
                if($class_list==null){
                    $class_list=array($i); 
                }else{
                    array_push($class_list, $i);
                }
            }
        }

        return view('layouts.lecturer.viewclass',['class_list'=> $class_list]);
            
    }

    function view_class_detail($id)
    {
        
        
        $idx = Auth::user()->id;
        $class_detail = Classes::find($id);    

        return view('layouts.lecturer.viewclassdetail',['class_detail'=> $class_detail]);
    }

    function create_assignment($id)
    {      
        $idx = Auth::user()->id;
        $class_detail = Classes::find($id);
        return view('layouts.lecturer.createassignment',['class_detail'=> $class_detail]); 
    }


    function submit_create_assignment(Request $req)
    {
       //return $req->clicks;
       //return $req->section_name3;
       //return $req->section_name;
       //return $req->criteria2;
       //return $req->criteria_mark;
       //return $req->total_section;
       
        Assignment::create([

           'class_id' => $req->class_id,
           'class_name' =>$req->class_name,
            'assignment_name' => $req->assignment_name,
            'assignment_description' => $req->assignment_description,
            'final_report_due_date' => $req->final_report_due_date,
            'peer_marks_due_date' => $req->peer_marks_due_date,
            'final_report_grace_period'=>$req->final_report_grace_period,
            'peer_marks_grace_period'=>$req->final_report_grace_period,
            
        ]);
        
        $assignment_name=$req->assignment_name;

        $data = DB::table('assignments')->where([ ['class_id', '=', $req->class_id], ['assignment_name', '=', $assignment_name] ])->get();
        //get the id of the student assignment in the student assignment table
        foreach($data as $i){
            $data_id = $i->id;
        }

        $assignment = Assignment::Find($data_id);

        //return $assignment;
        
        //create the json data for peer evaluation statuss
        $assignment_data = $assignment->rubric;
        $assignment_data['total_sections']=$req->total_section;
        $assignment_total_marks = null;
        
        //$section = "section1";
        //$assignment_data[$section]['section_name'] = $req->section_name1;
        //$assignment_data[$section]['criteria'] = $req->criteria1;
        //$assignment_data[$section]['criteria_marks'] =$req->criteria_mark1;

        $total_section=$req->total_section;
            for($i=1; $i<$total_section+1; $i++)
            {
                $section = "section".$i; 
                $section_name = "section_name".$i;
                $criteria = "criteria".$i;
                $criteria_mark ="criteria_mark".$i;
                $assignment_data[$section]['section_name'] = $req->$section_name;
                $assignment_data[$section]['criteria'] = $req->$criteria;

                $criteria_marks_array = $req->$criteria_mark; 
                //return  $criteria_marks_array;
                $marks_no = count($criteria_marks_array);

                $current_mark = $req->$criteria_mark;
                $total_marks = null;
                for($j=0; $j<$marks_no; $j++){
                    $total_marks = $total_marks + $current_mark[$j];
                }

                
                $assignment_total_marks=$assignment_total_marks+$total_marks;
                
	            $assignment_data[$section]['criteria_marks'] =$req->$criteria_mark;
	            $assignment_data[$section]['total_marks'] =$total_marks;
            }
        $assignment_data['assignment_total_marks']=$assignment_total_marks;
        
        $assignment->rubric=$assignment_data;
        $assignment->save();

        //loop student joined in this class
        //student list 
        //create student_assignment database row for every student


           

        
       return redirect()->back()->withSuccess('Assignment Successfully Created!');
    }

    function update_assignment_detail(Request $req) {
        $data = Assignment::find($req->assignment_id);
        // echo("<script>console.log('PHP: " . $req->assignment_id . "');</script>");
        $data->assignment_name = $req->assignment_name;
        $data->assignment_description = $req->assignment_description;
        $data->final_report_due_date = $req->final_report_due_date;
        $data->peer_marks_due_date = $req->peer_marks_due_date;
        $data->final_report_grace_period = $req->final_report_grace_period;
        $data->peer_marks_grace_period = $req->peer_marks_grace_period;
        
        // $rubric_data = $data->rubric;
        // $rubric_data['total_sections'] = $req->total_section;
        // $total_marks = null;

        // for($i = 1; $i <= $req->total_section; $i++){
        //     $section = "section".$i; 
        //     $section_name = "section_name".$i;
        //     $criteria = "criteria".$i;
        //     $criteria_mark ="criteria_mark".$i;
        //     $rubric_data[$section]['section_name'] = $req->section_name;
        //     $rubric_data[$section]['criteria'] = $req->criteria;
        // }

        // $assignment_data = $data->rubric;
        $assignment_data['total_sections']=$req->total_section;
        $assignment_total_marks = null;
        
        //$section = "section1";
        //$assignment_data[$section]['section_name'] = $req->section_name1;
        //$assignment_data[$section]['criteria'] = $req->criteria1;
        //$assignment_data[$section]['criteria_marks'] =$req->criteria_mark1;

        $total_section=$req->total_section;
            for($i=1; $i<$total_section+1; $i++)
            {
                $section = "section".$i; 
                $section_name = "section_name".$i;
                $criteria = "criteria".$i;
                $criteria_mark ="criteria_mark".$i;
                $assignment_data[$section]['section_name'] = $req->$section_name;
                $assignment_data[$section]['criteria'] = $req->$criteria;

                $criteria_marks_array = $req->$criteria_mark; 
                //return  $criteria_marks_array;
                $marks_no = count($criteria_marks_array);

                $current_mark = $req->$criteria_mark;
                $total_marks = null;
                for($j=0; $j<$marks_no; $j++){
                    $total_marks = $total_marks + $current_mark[$j];
                }

                
                $assignment_total_marks=$assignment_total_marks+$total_marks;
                
	            $assignment_data[$section]['criteria_marks'] =$req->$criteria_mark;
	            $assignment_data[$section]['total_marks'] =$total_marks;
            }
        $assignment_data['assignment_total_marks']=$assignment_total_marks;
        
        $data->rubric=$assignment_data;
        $data->save();
        

        return redirect("/lecturer/viewclassdetail/" . $req->class_id)->withSuccess('Assignment Successfully Updated.');
    }


    function view_assignment($id)
    {
        $idx = Auth::user()->id;
        $class_detail = Classes::find($id);
        $assignment_detail = DB::table('assignments')->where('class_id','=',$id)->get();
        return view('layouts.lecturer.viewclassdetail',['assignment_detail'=> $assignment_detail, 'class_detail'=> $class_detail]);
        
    }

    function delete_assignment($id, $assignment_id)
    {
        DB::delete('delete from assignments where id = ?', [$assignment_id]);
    
        return redirect()->back()->withSuccess('Assignment Successfully Deleted');
    }


    function view_assignment_detail($assignment_id)
    {
      
       
        $assignment_detail = DB::table('assignments')->where([['id','=',$assignment_id]])->get();

        
        
        return view('layouts.lecturer.viewassignmentdetail',['assignment_detail'=> $assignment_detail]);
    }

    function edit_assignment_detail($id, $assignment_id) {

        $id = Auth::user()->id;
        $class_detail = Classes::find($id);
        $assignment = Assignment::find($assignment_id);
        // echo("<script>console.log('PHP: " . $assignment_id . "');</script>");
        
        return view('layouts.lecturer.editassignment', ['class_detail'=> $class_detail, 'assignment_detail'=>$assignment]);
    }
    


}
    