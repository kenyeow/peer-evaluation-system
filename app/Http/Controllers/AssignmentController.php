<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Assignment;
use App\Models\StudentAssignment;

class AssignmentController extends Controller
{
    public function show_assignments($class_name, $id)
    {
        //loop and get the assignments for the class in assignments database with the class name and id
        //the assignments for that class will be saved in the variable $class_assignments
        //$id is class_id
        $class_assignments = null;
        $assignments_data = DB::table('assignments')->get();
        
        foreach ($assignments_data as $i){
            if($i->class_id==$id){
                if($class_assignments==null){
                    $class_assignments=array($i); 
                }else{
                    array_push($class_assignments, $i);
                }
            }
        }

        //if there is no assignment in that class it will just return back the class name
        if($class_assignments==null){
            $class_assignments=$class_name;
        }else{
            //if there is assignment in the class
            //loop and check whether already have database record in student_assignments database for those assignments
            //this record enable students to perform action in submit, feedback, evaluate and reults phase
            $user_id = Auth::user()->id;
            
            foreach($class_assignments as $c){
                $record = null;
                $assignment_id = $c->id;
                $record = DB::table('student_assignments')->where([ ['student_id', '=', $user_id],['class_id', '=', $id], ['assignment_id', '=', $assignment_id] ])->get();
                
                //If no record in database, create a new record
                if($record == '[]'){

                    StudentAssignment::create([
                        'student_id' => $user_id,
                        'class_id' => $id,
                        'assignment_id' => $assignment_id,
                        'submit_status' => 'not completed',
                        'feedback_status'=> 'not completed',
                        'evaluate_status'=> 'not completed',
                    ]);
                }
            }
        }

        return view('layouts.student.assignments',['class_assignments'=> $class_assignments]);
    }

    public function show_assignments_list()
    {
        $id = Auth::user()->id;
        $student_class=null;
        $class_code = Auth::user()->class_code;
        $class_data = DB::table('classes')->get();

        //check whether student have added any classes
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

            $student_assignments = null;

            foreach($student_class as $s){
                $class_id = $s->id;
                $assignments_data = DB::table('assignments')->get();
                
                foreach ($assignments_data as $i){
                    if($i->class_id==$class_id){
                        if($student_assignments==null){
                            $student_assignments=array($i); 
                        }else{
                            array_push($student_assignments, $i);
                        }
                    }
                }
            }

            //there is assignments in all the classes that the student joined
            if($student_assignments != null){

                //loop and check whether already have database record in student_assignments database for those assignments
                //this record enable students to perform action in submit, feedback, evaluate and reults phase
                foreach($student_assignments as $c){
                    $record = null;
                    $class_id = $c->class_id;
                    $assignment_id = $c->id;
                    $record = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();
                    
                    //If no record in database, create a new record
                    if($record == '[]'){

                        StudentAssignment::create([
                            'student_id' => $id,
                            'class_id' => $class_id,
                            'assignment_id' => $assignment_id,
                            'submit_status' => 'not completed',
                            'feedback_status'=> 'not completed',
                            'evaluate_status'=> 'not completed',
                        ]);
                    }
                }

                $assignment_list=null;
                $student_assignments_data = DB::table('student_assignments')->get();

                foreach ($student_class as $x){
                    foreach ($student_assignments_data as $y){
                        if($y->student_id==$id && $y->class_id==$x->id){
                            if($assignment_list==null){
                                $assignment_list=array($y); 
                            }else{
                                array_push($assignment_list, $y);
                            }
                        }
                    }
                }

                //check whether have any assignments in the classes that the student have joined
                $assignment_data = DB::table('assignments')->get();
                $assignment_number = null;

                foreach ($student_class as $a){
                    $counter = null;
                    foreach ($assignment_data as $b){
                        if($a->id == $b->class_id){
                            $counter = 'exist';
                        }
                    }

                    if($counter == 'exist'){
                        if($assignment_number==null){
                            $assignment_number=array('yes'); 
                        }else{
                            array_push($assignment_number, 'yes');
                        }
                    }else{
                        if($assignment_number==null){
                            $assignment_number=array('no'); 
                        }else{
                            array_push($assignment_number, 'no');
                        }
                    }
                }

                return view('layouts.student.assignmentslist',['student_class'=> $student_class, 'assignment_list'=> $assignment_list, 'assignment_data'=>$assignment_data, 'assignment_number'=>$assignment_number]);
            
            }else{
                // no any assignments in all of the classes that the student joined
                $assignment_list = null;
                return view('layouts.student.assignmentslist',['student_class'=> $student_class, 'assignment_list'=> $assignment_list,]);
            }
        }else{
            //student have not added any classes thus assignment list is also empty
            $assignment_list = null;
            return view('layouts.student.assignmentslist',['student_class'=> $student_class, 'assignment_list'=> $assignment_list,]);
        }

        
    }
        
    public function show_grade_appeal_list()
    {
        $id = Auth::user()->id;
        $student_class=null;
        $class_code = Auth::user()->class_code;
        $class_data = DB::table('classes')->get();

        //check whether student have added any classes
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


            //get the list of assignments from the clases that the student joined
            $assignment_list=null;
            $student_assignments_data = DB::table('student_assignments')->get();

            foreach ($student_class as $x){
                foreach ($student_assignments_data as $y){
                    if($y->student_id==$id && $y->class_id==$x->id){
                        if($assignment_list==null){
                            $assignment_list=array($y); 
                        }else{
                            array_push($assignment_list, $y);
                        }
                    }
                }
            }

            //get the grade appeal list by checking the grade appeal status in the assignments that have been assigned to students
            if($assignment_list != null){
                $grade_appeal_list=null;
                foreach ($assignment_list as $a){
                    if($a->grade_appeal_status != null){
                        if($grade_appeal_list==null){
                            $grade_appeal_list=array($a); 
                        }else{
                            array_push($grade_appeal_list, $a);
                        }
                    }
                }
            }else{
                //there is no assignments in the classes that the student joined thus no grade appeal
                $grade_appeal_list=null;
            }

            $assignment_data = DB::table('assignments')->get();

            return view('layouts.student.gradeappeal',['student_class'=> $student_class,'grade_appeal_list'=> $grade_appeal_list, 'assignment_data'=>$assignment_data]);

        }else
        {
            $grade_appeal_list = null;
            return view('layouts.student.gradeappeal',['grade_appeal_list'=> $grade_appeal_list]);
        }

        
    }
    
}
