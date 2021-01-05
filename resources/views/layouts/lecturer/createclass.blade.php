@extends('layouts.lecturer.dashboard')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-10">
            <h4>Welcome back {{ Auth::user()->name }} !</h4>
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">category</i>
                    </div>
                    <div class="card-content">
                        </br>
                        <div class="form-group  is-empty">
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
                            <form action="/lecturer/createclass" method="POST">
                            @csrf
                            <input type="text" name="class_code" class="form-control" placeholder="class code"></input>
                            <input type="text" name="class_name" class="form-control" placeholder="class name"></input>
                            


                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary filter-button">Create</button> 
                            </div> 
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                       
                    </div>
                </div>
            </div>

           
            
            
        </div>
    </div>
</div>
@endsection