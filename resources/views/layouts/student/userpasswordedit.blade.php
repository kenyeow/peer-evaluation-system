@extends('layouts.student.dashboard')

@section('title', 'User Profile')

@section('page-title', 'User Profile')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
            <h4>{{ __('Edit your password here!') }} </h4>
            </div>

            <form method="POST" action="/student/user-password-edit">
            @csrf
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Change Password</h4>
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
                        <h4 class="title">Current Password</h4>
                        <input id="password" type="password" placeholder="Password..." class="form-control @error('password') is-invalid @enderror" name="current_password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="card-content">
                        <h4 class="title">New Password</h4>
                        <input id="password" type="password" placeholder="Password..." class="form-control @error('password') is-invalid @enderror" name="new_password" >
                        @error('password')
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