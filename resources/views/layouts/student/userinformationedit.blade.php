@extends('layouts.student.dashboard')

@section('title', 'User Profile')

@section('page-title', 'User Profile')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
            <h4>{{ __('Edit your user information here!') }} </h4>
            </div>

            <form method="POST" action="/student/user-information-edit">
            @csrf
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Change User Information</h4>
                    </div>
                    <div class="card-content">
                        <h4 class="title">New Name</h4>
                        <input id="name" type="text" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    
                    <div class="card-content">
                        <h4 class="title">New Email</h4>
                        <input id="email" type="email" value="{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="btn-group pull-right">
                        <button type="submit" class="btn btn-primary">Save</button> 
                        </div>
                        <div class="btn-group pull-left">
                        <a href="/student/user-profile" class="btn btn-primary filter-button">Back</a> 
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection