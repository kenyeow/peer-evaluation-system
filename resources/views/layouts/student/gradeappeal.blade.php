@extends('layouts.student.dashboard')

@section('title', 'Grade Appeal')

@section('page-title', 'Grade Appeal')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
            <h4>{{ __('Check your grade appeal status here!') }} </h4>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Grade Appeal</h4>
                    </div>
                    @if($grade_appeal_list == null)
                    <div class="card-content">
                        <h4>You have not perform any grade appeal!</h4>  
                    </div>
                    @else
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>Class Name</th>
                                <th>Assignment Name</th>
                                <th>Grade Appeal Submission date</th>
                                <th>Approval Status</th>
                            </thead>
                            <tbody>
                            
                                @foreach($grade_appeal_list as $list)
                                    <tr>
                                        @foreach($student_class as $class)
                                        @if($list->class_id == $class->id)
                                            <td>{{$class->class_name}}</td>
                                        @endif
                                        @endforeach

                                        @foreach($assignment_data as $assignment)
                                        @if($list->assignment_id == $assignment->id)
                                            <td>{{$assignment->assignment_name}}</td>
                                        @endif
                                        @endforeach

                                        <td>{{$list->grade_appeal_date}}</td>

                                        @if($list->grade_appeal_status == 'pending')
                                            <td>Pending</td>
                                        @elseif($list->grade_appeal_status == 'approved')
                                            <td>Approved</td>
                                        @elseif($list->grade_appeal_status == 'rejected')
                                            <td>Rejected</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection