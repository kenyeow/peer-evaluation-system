@extends('layouts.student.dashboard')

@section('title', 'Assignments List')

@section('page-title', 'Assignments List')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
            <h4>{{ __('This is your assignments list!') }} </h4>
            </div>
            @if($assignment_list == null)
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Assignments</h4>
                    </div>
                    <div class="card-content">
                        <h4>There is no assignments!</h4>  
                    </div>
                </div>
            </div>
            @else
                @php
                $counter = 0;
                @endphp
                    @foreach($student_class as $class)
                            @if($assignment_number[$counter]=="yes")
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header" data-background-color="blue">
                                            <h4 class="title">{{$class->class_name}} Assignments</h4>
                                            <!--<p class="category">Latest assignments posted on 15th September, 2020</p>-->
                                        </div>
                                        
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                            <th>Assignment Name</th>
                                            <th>Final Report</th>
                                            <th>Peer Marks</th>
                                        </thead> 
                            @endif
                
                                    @foreach($assignment_list as $list)
                                        @if($list->class_id == $class->id)
                                            <tbody>
                                                <tr>
                                                    @foreach($assignment_data as $assignment)
                                                    @if($list->assignment_id == $assignment->id)
                                                        <td>{{$assignment->assignment_name}}</td>
                                                    @endif
                                                    @endforeach
                                                    @if($list->submit_status == 'completed')
                                                        <td>Completed</td>
                                                    @else
                                                        <td>Not Completed</td>
                                                    @endif

                                                    @if($list->evaluate_status == 'completed')
                                                        <td>Completed</td>
                                                    @else
                                                        <td>Not Completed</td>
                                                    @endif
                                                </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @php
                $counter = $counter + 1;
                @endphp
                
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection