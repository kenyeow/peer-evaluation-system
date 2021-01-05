@extends('layouts.lecturer.dashboard')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-10">
            <h4>List Of Classes Created</h4>
                <div class="card card-stats">
                    <div class="card-header" data-background-color="green">
                        <i class="material-icons">class</i>
                    </div>
                    <div class="card-content">
                        </br>
                     <div>
                            <table class ="table table-bordered">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                </tr>
                 
                        

                        @foreach($class_list as $i)
                                
                            <tr>
                                <td>{{$i-> class_code}}</td>
                                <td>{{$i-> class_name}}</td>
                            </tr>
                            
                    
                        @endforeach

                        </table>


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