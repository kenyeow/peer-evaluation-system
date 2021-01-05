@extends('layouts.student.dashboard')

@section('title', 'Feedback Phase')

@section('page-title', 'Feedback Phase')

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
                    @if($y->submit_status == 'completed' && $y->feedback_status == 'not completed')
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
                        </div>
                        <div class="card-footer">
                            @if ($y->feedback == null)
                                <p>No Feedback Received!</p>
                            @else
                                @php
                                $counter = 0;
                                @endphp
                                @foreach($my_peer_feedback as $a)
                                    @php
                                    $counter =  $counter + 1;
                                    @endphp
                                @endforeach
                                @for($i=0; $i< $counter; $i++)
                                    <h6 style="font-weight: bold; color: black; margin-bottom: 3px;">{{$my_peer_name[$i]}}</h6>
                                    <p>{{$my_peer_feedback[$i]}}</p>
                                @endfor
                            @endif
                        </div>
                    </div>      
                    
                    @if($peers_list != null)
                        @foreach($peers_list as $p)
                        <div class="card" style="border-style: solid;border-width: 1px;border-color: green;">
                            <div class="card-header"data-background-color="green">
                                @foreach($student_data as $s)
                                    @if($p->student_id == $s->id)
                                        <h4 class="title">{{$s->name}} Draft Report</h4>
                                    @endif
                                @endforeach
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    </br>
                                    <p>{{$p->draft_report_name}}
                                    <a href= "/download/final_report/{{$y->class_id}}/{{$y->assignment_id}}" class="stretched-link" style="text-decoration: underline;color:blue;padding:30px;">Download Draft Report</a></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if($p->feedback != null)
                                    <h6 style="font-weight: bold; color: black; margin-bottom: 3px;">{{Auth::user()->name}}</h6>
                                    <p>This is a feedback given by {{Auth::user()->name}}...</p>
                                    <h6 style="font-weight: bold; color: black; margin-bottom: 3px;">Ng Yan Yan</h6>
                                    <p>This is a feedback given by Ng Yan Yan...</p>
                                @endif
                                <form action='/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/submit_feedback' method="POST" >
                                    @csrf
                                    <input class="form-control" type="text" name="feedback" style="border: solid 2px purple; padding: 10px; width: 520%; margin-top: -10%; border-radius: 10px;"placeholder="Leave a feedback to your peers..." />
                                    <input name="class_id" value="{{$class_id}}" type="hidden">
                                    <input name="assignment_id" value="{{$assignment_id}}" type="hidden">
                                    <input name="peer_id" value="{{$p->student_id}}" type="hidden">
                                    <button type="submit" name="submit" class="btn btn-primary filter-button pull-right" style=" margin-top: 0.5%; ">Submit</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-content">
                                <h4>There is no peers draft report submission yet!</h4>  
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="btn-group pull-right">
                        <a href="/student/{{$class_name}}/{{$class_id}}/{{$assignment_name}}/{{$assignment_id}}/submit_final_report" class="btn btn-primary filter-button">Submit Draft Report as Final Report</a> 
                    </div>
                    @elseif($y->submit_status == 'completed' && $y->feedback_status == 'completed')
                        <div class="card" style="border-style: solid;border-width: 1px;border-color: purple;">
                            <div class="card-header"data-background-color="purple">
                                <h4 class="title">Final Report</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    </br>
                                    <p style="">{{$y->final_report_name}}
                                    <a href= "/download/final_report/{{$y->class_id}}/{{$y->assignment_id}}" class="stretched-link" style="text-decoration: underline;color:blue;padding:30px;">Download Final Report</a></p>
                                </div>
                            </div>
                            <div class="card-footer">
                            @if ($y->feedback == null)
                                <p>No Feedback Received!</p>
                            @else
                                @php
                                $counter = 0;
                                @endphp
                                @foreach($my_peer_feedback as $a)
                                    @php
                                    $counter =  $counter + 1;
                                    @endphp
                                @endforeach
                                @for($i=0; $i< $counter; $i++)
                                    <h6 style="font-weight: bold; color: black; margin-bottom: 3px;">{{$my_peer_name[$i]}}</h6>
                                    <p>{{$my_peer_feedback[$i]}}</p>
                                @endfor
                            @endif
                            </div>
                        </div>      
                    
                        @if($peers_list != null)
                            @foreach($peers_list as $p)
                            <div class="card" style="border-style: solid;border-width: 1px;border-color: green;">
                                <div class="card-header"data-background-color="green">
                                    @foreach($student_data as $s)
                                        @if($p->student_id == $s->id)
                                            <h4 class="title">{{$s->name}} Draft Report</h4>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        </br>
                                        <p>{{$p->draft_report_name}}
                                        <a href= "/download/final_report/{{$y->class_id}}/{{$y->assignment_id}}" class="stretched-link" style="text-decoration: underline;color:blue;padding:30px;">Download Draft Report</a></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @if($p->feedback != null)
                                        <h6 style="font-weight: bold; color: black; margin-bottom: 3px;">{{Auth::user()->name}}</h6>
                                        <p>This is a feedback given by {{Auth::user()->name}}...</p>
                                        <h6 style="font-weight: bold; color: black; margin-bottom: 3px;">Ng Yan Yan</h6>
                                        <p>This is a feedback given by Ng Yan Yan...</p>
                                    @endif
                                    <form action='/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/submit_feedback' method="POST">
                                        @csrf   
                                        <input class="form-control" type="text" name="feedback" style="border: solid 2px purple; padding: 10px; width: 520%; margin-top: -10%; border-radius: 10px;"placeholder="Leave a feedback to your peers..." />
                                        <input name="class_id" value="{{$class_id}}" type="hidden">
                                        <input name="assignment_id" value="{{$assignment_id}}" type="hidden">
                                        <input name="peer_id" value="{{$p->student_id}}" type="hidden">
                                        <button type="submit" name="submit"class="btn btn-primary filter-button pull-right" style=" margin-top: 0.5%; ">Submit</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                <div class="card-content">
                                    <h4>There is no peers draft report submission yet!</h4>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="btn-group pull-right">
                            <a href="/student/{{$class_name}}/{{$class_id}}/{{$assignment_name}}/{{$assignment_id}}/evaluate" class="btn btn-primary filter-button">Proceed to Evaluate Phase</a> 
                        </div>
                    @else
                        <div class="card-body">
                            <h4 style="text-align:center;">Please complete the submit phase by submitting the draft report to able the access of the feedback phase.</h4>
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