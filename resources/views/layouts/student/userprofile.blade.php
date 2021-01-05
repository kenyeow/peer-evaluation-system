@extends('layouts.student.dashboard')

@section('title', 'User Profile')

@section('page-title', 'User Profile')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
            <h4>{{ __('This is your user profile!') }} </h4>
            </div>
            
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title">User Information</h4>
                    </div>
                    <div class="card-content">
                    </br>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                    @endif
                        <h4 class="title">Name<div class="btn-group pull-right"></h4>
                        <p class="category">{{ Auth::user()->name }}</p>
                        
                    </div>
                    <div class="card-content">
                        <h4 class="title">Email<div class="btn-group pull-right"></h4>
                        <p class="category">{{ Auth::user()->email }}</p><div class="btn-group pull-right">
                        <a href="/student/user-information-edit" class="btn btn-primary filter-button">Edit</a> 
                        </div>
                    </div> 
                    
                </div>
            </div>

           
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Password</h4>
                    </div>
                    <div class="card-content">
                    <h4 class="title">Password<div class="btn-group pull-right"></h4>
                        <p class="category">*******</p>
                        <div class="btn-group pull-right">
                        <a href="/student/user-password-edit" class="btn btn-primary filter-button">Edit</a> 
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection