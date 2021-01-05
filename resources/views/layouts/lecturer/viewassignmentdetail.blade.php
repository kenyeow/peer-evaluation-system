@extends('layouts.lecturer.dashboard')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

@foreach($assignment_detail as $i)
 {{$i->assignment_name}}
@endforeach

<div class="content">
    <div class="container-fluid">
        <div class="row">

    

            <!--------------->

            <div class="col-md-7">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="grey">
                        <h6>Student Submission Status</h6>
                    </div>
                    <div class="card-content" >
                    <br>
                    <br>
                    <br>
                    
                    <table class="table table-bordered">
                    <tr>
                        <th>Student List</th>
                        <th>Final Report</th>
                        <th>Peer Marks</th>
                        <th>Status</th>
                    </tr>
                    </table>
                    </div>
                </div>
            </div>
            
            <!--------------->
            <div class="content">
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="grey">
                        <h6>Action Panel</h6>
                    </div>
                    <div class="card-footer" >
                        <br>
                        <br>
                        <br>
                        <button class="btn btn-info">Peer Evaluator<br> Allocation</button>
                        <button class="btn btn-info">View Finalized <br> Grade</button> 
                        <button class="btn btn-info">View Grade <br> Appeal </button> 
                    </div>

                </div>
            </div>
            </div>
  





    </div>
</div>
@endsection