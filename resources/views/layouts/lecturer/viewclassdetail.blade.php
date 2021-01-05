@extends('layouts.lecturer.dashboard')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-10">

            

             <h4>Welcome to {{$class_detail->class_name}}! &nbsp&nbsp&nbsp Class Code : {{$class_detail->class_code}}</h4>
                <h4><b>Class Join Code : {{$class_detail->class_join_code}}</b></h4>
                

                <div class="card card-stats">

                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">add</i>
                        <a href ="/lecturer/viewclassdetail/{{$class_detail->id}}/createassignment"><h5> Create Assignment</h5></a>
                    </div>

                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">people</i>
                        <a href ="/lecturer/viewclassdetail/{{$class_detail->id}}/viewstudentlist"><h5>List of Students</h5></a>
                    </div>

                </div>

                <br>

            @foreach($assignment_detail as $i)
            <div>
                <div class="card card-stats">

                <div class="card-header" data-background-color="green">
                        <i class="material-icons">assignment</i>
                    <div>
                        <h6>{{$i->assignment_name}}</h6>
                        <h6>Final Report Due Date : {{$i->final_report_due_date}}</h6>
                        <h6>Peer Marks Due Date : {{$i->peer_marks_due_date}}</h6>
                        
                    </div>
                    
                       
                </div>
                <div>
                        <button class="btn btn-info"><a href="/lecturer/viewclassdetail/{{$class_detail->id}}/editassignment/{{$i->id}}" style="color:white;">Edit Assignment</a></button>
                        <button class="btn btn-info">Edit Rubric </button> 
                        <button class="btn btn-info"><a href="/lecturer/viewclassdetail/{{$class_detail->id}}/viewassignmentdetail/{{$i->id}}" style="color:white;">View Detail </a></button>
                        <button class="btn btn-danger"><a href="/lecturer/viewclassdetail/{{$class_detail->id}}/deleteassignment/{{$i->id}}">Remove Assignment</a></button>
                        <!-- <form action="/lecturer/viewclassdetail/{{$class_detail->id}}/deleteassignment/{{$i->id}}" method="post">
                            <input type="hidden" name="_method" value="DELETE" >
                            <input class="btn btn-danger" type="submit" value="Remove Assignment">
                        </form>  -->
                        
                </div>
                </div>
            @endforeach   
            
        
            
            
            </div>
    </div>
</div>
@endsection