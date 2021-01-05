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
                    <div class="card-header" data-background-color="grey">
                        <i class="material-icons">assignment</i>
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

                          
                            
                        <form action="/lecturer/viewclassdetail/{id}/createassignment" method="POST">
                            
                                                
                            @csrf
                            <input type="hidden" name="class_id" class="form-control" value="{{$class_detail->id}}"></input>
                            <input type="hidden" name="class_name" class="form-control" value="{{$class_detail->class_name}}"></input>
                            <input type="text" name="assignment_name" class="form-control" placeholder="Assignment Name"></input>
                            <input type="text" name="assignment_description" class="form-control" placeholder="Assignment Description"></input>
            
                            <br>
                            <div>
                                <div style="float:left; position:relative;">
                                    <h6 style="margin-right:5em; width:100%; text-align:left;">Final Report Due Date & Time</h6>
                                    <input style="margin-right:5em; float:left; position:relative;" type="datetime-local" name="final_report_due_date" class="form-control" placeholder="Final Report Due Date"></input>
                                    <br>
                                    <h6 style="margin-right:5em; text-align:left;">Peer Marks Due Date & Time</h6>
                                    <input style="margin-right:5em; float:left; position:relative;" type="datetime-local" name="peer_marks_due_date" class="form-control" placeholder="Peer Marks Due Date"></input>
                                    <br>
                               </div>
                                
                               <div style="float:left; position:relative;">
                                    <h6 style="text-align:left; margin-left:5em">Final Report Grace Period</h6>
                                    <input style="margin-left:5em; float:left; position:relative;" type="datetime-local" name="final_report_grace_period" class="form-control" placeholder="Final Report Grace Period"></input>
                                    <br>
                                    <h6 style="text-align:left; margin-left:5em">Peer Marks Grace Period</h6>
                                    <input style="margin-left:5em; float:left; position:relative;" type="datetime-local" name="peer_marks_grace_period" class="form-control" placeholder="Peer Marks Grace Period"></input>
                                    <br><br>
                                </div>                     
                            </div>
                            
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <h6 style="text-align:center; font-weight:bold;">Rubric Creation</h6>
                            <br>

                            <div style="text-align:center;">

                                <table style="width:100%; text-align:center;">
                                    @php
                                    $count = 1;
                                    @endphp
                                    <tr style="text-align:center;">
                                    <th>Section name </th>
                                    <td><input type="text" name="section_name{{$count}}" class="form-control" placeholder="Section Name"></input></td>
                                    </tr>



                                    <tr style="text-align:center;">
                                    <th >Criteria List</th>
                                    <td><input type="text" name="criteria{{$count}}[]" class="form-control" placeholder="Criteria List"></input></td>
                                
                                    <th>Criteria Mark</th>
                                    <td><input type="text" name="criteria_mark{{$count}}[]" class="form-control" placeholder="Criteria List"></input></td>

                                    <td style="text-align:center;"><a href="#" id="addRow" class="btn btn-info addRow">+</a></td>
                                    </tr>
                                    
                                </table>
  
                            </div>

                            <div style="text-align:center">
                                <div>
                                <a href ="#" id="addnewsection" onCLick="onClickaddsection()" class="btn btn-warning addnewsection">Add New Section</a>
                                </div>

                                <div class="btn-group">
                                <button style=" position:relative;" type="submit" class="btn btn-primary filter-button">Create Assignment</button> 
                                </div> 
                            </div> 
                            
                            Section Clicks: <a id="clickss[]"name="clickss[]">1</a>
                            <input type="hidden" id="total_section" name="total_section" class="form-control" value='1'></input>
                            </form>                       
                        
                        </div>
                    </div>




                    <div class="card-footer">
                   
                   

                    </div>
                </div>
            </div>         
            
        </div>
    </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">

     $('.addRow').on('click',function(){
         addRow();
         });
     function addRow()
        {
            var count =  document.getElementById("clickss[]").innerHTML;
            var tr =
                        '<tr style="text-align:center;">'+
                                '<th>Criteria List</th>'+
                                '<td><input type="text" name="criteria'+count+'[]" class="form-control" placeholder="Criteria List"></input></td>'+
                                
                                '<th>Criteria Mark</th>'+
                                '<td><input type="text" name="criteria_mark'+count+'[]" class="form-control" placeholder="Criteria Marks"></input></td>'+

                                '<td style="text-align:center;"><a href="#" id="addRow" class="btn btn-danger remove">-</a></td>'+
                        '</tr>';
                        $('tbody').append(tr); 
                                          
        };

        $('tbody').on('click','.remove',function()
        {
             $(this).parent().parent().remove();
        });

        $('.addnewsection').on('click',function(){
         addnewsection();
         });

        function addnewsection()
         {
            var count =  document.getElementById("clickss[]").innerHTML;
        
             var tr =
                        '<tr style="text-align:center;">'+
                                '<th>Section name</th>'+
                                '<td><input type="text" name="section_name'+count+'" class="form-control" placeholder="Section Name"></input></td>'+
                                '<td style="text-align:center;"><a href="#" id="addRow" class="btn btn-danger remove">-</a></td>'+
                      '</tr>';
                    
                      $('tbody').append(tr); 
        };
        $('tbody').on('click','.remove',function()
        {
             $(this).parent().parent().remove();
        });

        var clicks = 1
        function onClickaddsection() 
        {
            clicks += 1;
            document.getElementById("clickss[]").innerHTML = clicks;
            document.getElementById("total_section").value = clicks;


        };

</script>
@endsection