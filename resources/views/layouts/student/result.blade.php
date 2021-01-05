@extends('layouts.student.dashboard')

@section('title', 'Result Phase')

@section('page-title', 'Result Phase')

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
            
        @foreach($student_assignment as $assignment)   
            @if($assignment->grade != null) 
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card" style="border-style: solid;border-width: 1px;border-color: purple;margin-left:25px;width: 96%;">
                            <div class="card-content">
                                <div class="card-body">
                                    
                                        <h4 class="title" style="font-weight: bold;font-family:'Nunito', sans-serif;">Grade: {{$assignment->grade}}</h4>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="card-content">

                        <div class="btn-group btn-group-justified">
                        <a href="#" class="btn btn-primary filter-button input-block-level">View Peer Marks Received</a> 
                        </div>
                        <div class="btn-group btn-group-justified">
                        <a href="#" class="btn btn-primary filter-button btn-block">View Peer Marks Given</a> 
                        </div>
                        <div class="btn-group btn-group-justified">
                        <a href="#" class="btn btn-primary filter-button btn-block">View Grade Breakdown</a> 
                        </div>
                        <div class="btn-group btn-group-justified">
                        <a href="#" class="btn btn-primary filter-button btn-block">Grade Appeal</a> 
                        </div></div>
                    </div>
                </div>      
            @else
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 style="text-align:center;">The result is not release yet!</h4>
                    </div>
                </div>
            </div>
            @endif
        @endforeach       
        </div>
    </div>
</div>
@endsection