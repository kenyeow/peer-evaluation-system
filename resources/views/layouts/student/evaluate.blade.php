@extends('layouts.student.dashboard')

@section('title', 'Evaluate Phase')

@section('page-title', 'Evaluate Phase')

@section('content')

<div class="btn-group pull-right">
    <a href="#" class="btn btn-primary filter-button"><div><i class="material-icons">import_contacts</i></div>Rubric</a>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card card-nav-tabs ">
            <div class="card-header" data-background-color="purple">
                <ul class="nav nav-tabs justify-content-center" >
                    <li class="">
                        <a href="/student/{{$class_name}}/{{$class_id}}/{{$assignment_name}}/{{$assignment_id}}/submit">
                            <i class="material-icons">assignment</i>
                            Submit
                            @foreach($student_assignment as $y)
                                @if($y->submit_status == 'completed')
                                    <i class="material-icons">done</i> 
                                @endif
                            @endforeach
                            <div class="ripple-container"></div></a>
                        </li>
                        <li class="">
                            <a href="/student/{{$class_name}}/{{$class_id}}/{{$assignment_name}}/{{$assignment_id}}/feedback" >
                                <i class="material-icons">question_answer</i>
                                Feedback
                                @foreach($student_assignment as $y)
                                    @if($y->feedback_status == 'completed')
                                        <i class="material-icons">done</i> 
                                    @endif
                                @endforeach
                                <div class="ripple-container"></div></a>
                            </li>
                            <li class="">
                                <a href="/student/{{$class_name}}/{{$class_id}}/{{$assignment_name}}/{{$assignment_id}}/evaluate" >
                                    <i class="material-icons">rule</i>
                                    Evaluate
                                    @foreach($student_assignment as $y)
                                        @if($y->evaluate_status == 'completed')
                                            <i class="material-icons">done</i> 
                                        @endif
                                    @endforeach
                                    <div class="ripple-container"></div></a>
                                </li>
                                <li class="">
                                <a href="/student/{{$class_name}}/{{$class_id}}/{{$assignment_name}}/{{$assignment_id}}/result">
                                    <i class="material-icons">grade</i>
                                    Result
                                    @foreach($student_assignment as $y)
                                        @if($y->grade != null)
                                            <span class="badge badge-success" > RELEASED </span>
                                        @endif
                                    @endforeach
                                    <div class="ripple-container"></div></a>
                                </li>
                            </ul>
                                
                        
            </div>
        </div>
    </div>    
</div>    

<div class="content">
    <div class="container-fluid">
        <div class="row">
            
            
        <div class="col-lg-12 col-md-12">
            <div class="card">
            
                <div class="card-content">
                
                @if (session('success'))
                    <div class="alert alert-success text-justify" role="alert">
                        {{session('success')}}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger text-justify" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                @foreach($student_assignment as $y)
                    @if($y->submit_status == 'completed' && $y->feedback_status == 'completed')
                        <div class="card" style="border-style: solid;border-width: 1px;border-color: purple;">
                            <div class="card-header"data-background-color="purple">
                                <h4 class="title">Peer 1 Final Report</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    </br>
                                    <p style="">{{$y->final_report_name}}
                                    <a href= "/download/final_report/{{$y->class_id}}/{{$y->assignment_id}}" class="stretched-link" style="text-decoration: underline;color:blue;padding:30px;">Download Final Report</a></p>
                                </div>
                            </div>
                        </div>      
                        <div class="btn-group pull-right">
                            <a href="/student/result" class="btn btn-primary filter-button">Submit Peer Marks</a> 
                        </div>
                    @else
                        <div class="card-body">
                            <h4 style="text-align:center;">Please complete the submit phase and feedback phase by submitting the draft report and final report to able the access of the evaluate phase.</h4>
                        </div>
                    @endif
                @endforeach

                </div>
            </div>
        </div>    
             
            
        </div>
    </div>
</div>
@endsection