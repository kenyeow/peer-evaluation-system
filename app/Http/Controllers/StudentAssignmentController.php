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
use Illuminate\Support\Str;

class StudentAssignmentController extends Controller
{
    function create_student_assignment_record($class_id, $assignment_id)
    {
        $id = Auth::user()->id; 

        StudentAssignment::create([
            'student_id' => $id,
            'class_id' => $class_id,
            'assignment_id' => $assignment_id,
            'submit_status' => 'not completed', 
            'feedback_status' => 'not completed', 
            'evaluate_status' => 'not completed',
        ]);
    }

    public function submit_phase($class_name, $class_id, $assignment_name, $assignment_id)
    {
        $id = Auth::user()->id;
        $assignment_data = DB::table('assignments')->get();
        $assignment = null;
        $student_assignment = null;

        foreach ($assignment_data as $i){
            if ($i->id == $assignment_id){
                if($assignment==null){
                    $assignment=array($i); 
                }else{
                    array_push($assignment, $i);
                }
            }
        }
        
        $student_assignment = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();
        
        view()->share('class_name', $class_name);
        view()->share('class_id',  $class_id);
        view()->share('assignment_name', $assignment_name);
        view()->share('assignment_id', $assignment_id);

        return view('layouts.student.submit',['assignment'=> $assignment, 'student_assignment'=> $student_assignment]);
    }

    public function feedback_phase($class_name, $class_id, $assignment_name, $assignment_id)
    {
        $id = Auth::user()->id;
        $student_data = DB::table('students')->get();;
        $student_assignment_data = DB::table('student_assignments')->get();
        $peers_list = null;
        
        foreach ($student_assignment_data as $i){
            if ($i->student_id != $id && $i->class_id == $class_id && $i->assignment_id == $assignment_id && $i->draft_report != null){
                if($peers_list==null){
                    $peers_list=array($i); 
                }else{
                    array_push($peers_list, $i);
                }
            }
        } 
    
        view()->share('class_name', $class_name);
        view()->share('class_id',  $class_id);
        view()->share('assignment_name', $assignment_name);
        view()->share('assignment_id', $assignment_id);

        $student_assignment = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();
        
        $data_id = null;
        foreach($student_assignment as $i){
            $data_id = $i->id;
        }
        $my_peer_name = StudentAssignment::Find($data_id)->peer_name_feedback;
        $my_peer_feedback = StudentAssignment::Find($data_id)->feedback;
        
        return view('layouts.student.feedback', ['student_data'=> $student_data,'student_assignment'=> $student_assignment, 'peers_list'=> $peers_list, 'my_peer_name'=> $my_peer_name, 'my_peer_feedback'=> $my_peer_feedback]);
    }

    public function evaluate_phase($class_name, $class_id, $assignment_name, $assignment_id)
    {
        $id = Auth::user()->id;

        view()->share('class_name', $class_name);
        view()->share('class_id',  $class_id);
        view()->share('assignment_name', $assignment_name);
        view()->share('assignment_id', $assignment_id);

        $student_assignment = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();

        return view('layouts.student.evaluate', ['student_assignment'=> $student_assignment]);
    }

    public function result_phase($class_name, $class_id, $assignment_name, $assignment_id)
    {
        $id = Auth::user()->id;

        view()->share('class_name', $class_name);
        view()->share('class_id',  $class_id);
        view()->share('assignment_name', $assignment_name);
        view()->share('assignment_id', $assignment_id);

        $student_assignment = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();
        
        return view('layouts.student.result', ['student_assignment'=> $student_assignment]);
    }

    public function submit_draft_report(Request $req){
        
        $id = Auth::user()->id;
        $file = $req->file('draft_report');

        $allowedfileExtension=['pdf','jpg','png','docx'];
        if($req->hasFile('draft_report')){
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check=in_array($extension,$allowedfileExtension);
        }

        if($check){
            $oriFileName = $file->getClientOriginalName();
            $fileName = $id.'_'.$req->class_id.'_'.$req->assignment_id.'_'.time().'_'.$file->getClientOriginalName();
            $filePath = $req->file('draft_report')->storeAs('draft_report', $fileName, 'public');
            
            //save the file path
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $req->class_id], ['assignment_id', '=', $req->assignment_id]])->update(['draft_report' => $filePath]);
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $req->class_id], ['assignment_id', '=', $req->assignment_id]])->update(['draft_report_name' => $oriFileName]);

            //update the submit status
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $req->class_id], ['assignment_id', '=', $req->assignment_id]])->update(['submit_status' => 'completed']);
            
            return redirect()->back()->withSuccess('File successfully submited as Draft Report!');
        }else{
            return redirect()->back()->withError('Only Accept Files Types of pdf, jpg, png, and docx!');
        } 
   }

    public function download_draft_report($class_id, $assignment_id)
    {
        $id = Auth::user()->id;
        
        $student_assignment = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();
        foreach ($student_assignment as $i){
            $path = $i->draft_report;
        }
        
        //this will force download your file
        return Storage::disk('public')->download($path);
    }

    public function delete_draft_report($class_id, $assignment_id)
    {
        $id = Auth::user()->id;
        
        $student_assignment = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();

        foreach ($student_assignment as $i){
            $path = $i->draft_report;
            $final_report = $i->final_report;
        }

        //Check whether student already submitted it as final report
        if($final_report == null){
            $filePath = null;
            $fileName = null;
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['draft_report' => $filePath]);
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['draft_report_name' => $fileName]);
            
            Storage::disk('public')->delete($path);

            //update the submit status
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['submit_status' => 'not completed']);

            return redirect()->back()->withSuccess('Draft Report successfully deleted!');

        }else{
            //delete draft report
            $filePath = null;
            $fileName = null;
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['draft_report' => $filePath]);
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['draft_report_name' => $fileName]);
            
            Storage::disk('public')->delete($path);

            //delete final report
            $filePath = null;
            $fileName = null;
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['final_report' => $filePath]);
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['final_report_name' => $fileName]);
            
            Storage::disk('public')->delete($final_report);

            //update the status
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['submit_status' => 'not completed']);
            DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['feedback_status' => 'not completed']);

            return redirect()->back()->withSuccess('Draft Report and Final Report successfully deleted!');
        }
    }

    public function submit_final_report($class_name, $class_id, $assignment_name, $assignment_id)
    {
        $id = Auth::user()->id;
        
        $student_assignment = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();

        
        foreach ($student_assignment as $i){
            $path = $i->draft_report;
            $fileName = $i->draft_report_name;
        }

        //new path for the final report
        $new_path = Str::replaceFirst('draft_report', 'final_report', $path);

        DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['final_report' => $new_path]);
        DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['final_report_name' => $fileName]);

        //update the feedback status
        DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id]])->update(['feedback_status' => 'completed']);

        //copy the file to final report folder
        Storage::disk('public')->copy($path, $new_path);

        return redirect()->back()->withSuccess('Draft Report successfully submited as Final Report!');
    }

    public function download_final_report($class_id, $assignment_id)
    {
        $id = Auth::user()->id;
        
        $student_assignment = DB::table('student_assignments')->where([ ['student_id', '=', $id],['class_id', '=', $class_id], ['assignment_id', '=', $assignment_id] ])->get();
        foreach ($student_assignment as $i){
            $path = $i->final_report;
        }
        
        //this will force download your file
        return Storage::disk('public')->download($path);
    }

    public function submit_feedback(Request $req)
    {
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        
        $peer_data = DB::table('student_assignments')->where([ ['student_id', '=', $req->peer_id],['class_id', '=', $req->class_id], ['assignment_id', '=', $req->assignment_id] ])->get();
        
        foreach($peer_data as $i){
            $data_id = $i->id;
        }
        
        $data = StudentAssignment::Find($data_id);
        $peername = StudentAssignment::Find($data_id)->peer_name_feedback;
        $peerfeedback = StudentAssignment::Find($data_id)->feedback;
        
        //insert the peer name
        if ($data->peer_name_feedback==null){
            $data->peer_name_feedback=array($name);
        }else{
            array_push($peername, $name);
            $data->peer_name_feedback=$peername; 
        }

        //insert the peer feedback
        if ($data->feedback==null){
            $data->feedback=array($req->feedback);
        }else{
            array_push($peerfeedback, $req->feedback);
            $data->feedback=$peerfeedback;  
        }
        //save the updated data to database
        $data->save();
        
        return redirect()->back();
    
    }

}
