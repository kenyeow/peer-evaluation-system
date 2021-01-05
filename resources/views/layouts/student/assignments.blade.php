@extends('layouts.student.dashboard')

@section('title', 'Assignment')

@section('page-title', 'Assignments')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
            <h4>{{ __('This is the assignments inside the class!') }} </h4>
            </div>
            
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        @if (is_array($class_assignments))
                            <h4 class="title">{{$class_assignments[0]->class_name}} Assignments</h4>
                        @else
                            <h4 class="title">{{$class_assignments}} Assignments</h4>
                        @endif
                        <!--<p class="category">Latest assignments posted on 15th September, 2020</p>-->
                    </div>

                    @if(is_array($class_assignments))
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>Assignment Name</th>
                                <th>Final Report due date</th>
                                <th>Peer Marks due date</th>
                            </thead>
                            <tbody>

                        
                            @foreach($class_assignments as $assignments)
                                
                            <tr>
                                <td><a href="/student/{{$assignments->class_name}}/{{$assignments->class_id}}/{{$assignments->assignment_name}}/{{$assignments->id}}/submit">{{$assignments->assignment_name}}</td>
                                <td>{{$assignments->final_report_due_date}}</td>
                                <td>{{$assignments->peer_marks_due_date}}</td>
                            </tr></tbody>
                            
                    
                            @endforeach
                        @else
                        
                        <div class="card-content">
                            <h4>There is no assignments posted!</h4>  
                        </div>
                            
                        @endif
                    
                                
                    </table>
                    </div>            
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection