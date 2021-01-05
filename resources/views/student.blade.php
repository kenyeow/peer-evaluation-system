@extends('layouts.student.dashboard')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8">
            <h4>Welcome back {{ Auth::user()->name }}!</h4>
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">category</i>
                    </div>
                    <div class="card-content">
                        </br>
                        </br>
                        </br>
                        @if (session('success'))
                            <div class="alert alert-success text-justify" role="alert">
                                {{session('success')}}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger text-justify" role="alert">
                                {{session('error')}}
                            </div>
                        @endif
                        <form action="/student" method="POST">
                        @csrf
                        <input type="text" name="class_code" style="width: 80%; margin-bottom: -3%;"class="form-control" placeholder="Class Code...">
                        
                        <button type="submit" class="btn btn-primary filter-button" style="margin-right: 5%; margin-top: -9%; margin-bottom: -5%;">Join</button> 
                        
                        </form>
                        
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                        <i class="material-icons">info</i> Enter class code provided by lecturer to join new class
                        </div>
                    </div>
                </div>
            </div>

            @if($student_class!=null)
                @foreach($student_class as $class)
                    
                    <div class="row">
                        <div class="col-md-8" style="margin-left: 0.5%;">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="green">
                                    <div class="ct-chart" id="dailySalesChart"></div>
                                </div>
                                <div class="card-content">
                                    <a href="/student/{{$class->class_name}}/{{$class->id}}"><h4>{{$class->class_name}}</h4></a>
                                    <p class="category">{{$class->lecturer_name}}</p>
                                </div>
                                <!--
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> updated 4 minutes ago
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                    <div class="card-content">
                        <h4>You have not add any classes yet!</h4>  
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            

            
        </div>
    </div>
</div>
@endsection