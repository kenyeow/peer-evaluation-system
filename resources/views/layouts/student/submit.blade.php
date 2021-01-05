@extends('layouts.student.dashboard')

@section('title', 'Submit Phase')

@section('page-title', 'Submit Phase')

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
        

        @foreach($assignment as $x)   
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="orange">
                    <h4 class="title">{{$x->assignment_name}}</h4>
                    <h6 class="title">Due Date: {{$x->final_report_due_date}}</h6>
                </div>
                <div class="card-content">
                    <p>{{$x->assignment_description}}</p>
                    @if (session('success'))
                            <div class="alert alert-success text-justify" role="alert">
                                {{session('success')}}
                            </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger text-justify" role="alert">
                            {{session('error')}}
                        </div>
                    @endif
                    <div class="card-body">
                        @foreach($student_assignment as $y)
                            @if($y->draft_report != null)
                            <div class="card" style="border-style: solid;border-width: 1px;border-color: purple;">
                                 <div class="card-header"data-background-color="purple">
                                    <h4 class="title">Draft Report</h4>
                                </div>
                                <div class="card-content">
                               
                                    <div class="card-body">
                                        </br>
                                        <p style="">{{$y->draft_report_name}}
                                        <a href= "/download/draft_report/{{$y->class_id}}/{{$y->assignment_id}}" class="stretched-link" style="text-decoration: underline;color:blue;padding:30px;">Download Draft Report</a></p>
                                    </div>
                                    <div class="btn-group pull-right">
                                    <a href="/delete/draft_report/{{$y->class_id}}/{{$y->assignment_id}}" class="btn btn-primary filter-button">Delete</a> 
                                    </div>
                                </div>
                            </div>
                            @else
                                        <form action="/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/submit" method="post" enctype="multipart/form-data">
                                    
                                    @csrf
                                    
                                    <div class="card" data-background-color="orange">
                                    
                                        <div class="card-content">
                                        
                                            <div class="card-body">
                                                <div class="custom-file">
                                                    <label class="custom-file-label" style="text-align: right;clear: both;float:left;margin-right:15px;font-size: large;color:white;" for="chooseFile">Select file</label>
                                                    <input type="file" name="draft_report" class="custom-file-input" style="text-align: center;margin-left: 10%;" id="chooseFile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <input name="assignment_id" value="{{$x->id}}" type="hidden">
                                    <input name="class_id" value="{{$x->class_id}}" type="hidden">
                                    <div class="btn-group pull-right">
                                        <button type="submit" name="submit" class="btn btn-primary filter-button">
                                            Submit As Draft Report
                                        </button>
                                    </div>
                                </form>
                            @endif
                        @endforeach
                        
        @endforeach         

                </div>
            </div>
        </div>       
            
             
            
        </div>
    </div>
</div>
@endsection