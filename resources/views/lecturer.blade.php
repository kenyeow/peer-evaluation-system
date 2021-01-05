@extends('layouts.lecturer.dashboard')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">add</i>
                    </div>
                    <div class="card-content">
                        <a href="/lecturer/createclass" class="category">Create </br> Class</a>
                    </div>
                    <div class="card-footer">
                   
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="green">
                        <i class="material-icons">pageview</i>
                    </div>
                    <div class="card-content">
                        <a href="/lecturer/viewclass" class="category">View</br> Class</a>
                    </div>
                    <div class="card-footer">
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="red">
                        <i class="material-icons">info_outline</i>
                    </div>
                    <div class="card-content">
                        <p class="category">View </br>Class</p>
                    </div>
                    <div class="card-footer">
                    
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="fa fa-twitter"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">View </br>Class</p>
                   
                    </div>
                    <div class="card-footer">
                    
                       
                    </div>
                </div>
            </div>
        </div>

           
@endsection