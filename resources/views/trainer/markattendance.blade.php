@extends('trainer.layout.base')
@section('title', 'Mark Attendance')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('includes.form_alert')
        </div>
        <div class="col-md-12">
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" autocomplete="off" class="form-control datepicker" name="date_of_attd" id="startDate" placeholder="yyyy-mm-dd" required>
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="mdi mdi-calendar-check"></i>
                        </span>
                    </span>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><strong>Batch:</strong> {{$batch['name']}}</h4>
                    <div class="table-responsive"> 
                        @if(count($students))
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-hover table-bordered zero-configuration table-striped verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">username</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Phone No.</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>1</td>
                                        <td>Rahul</td>
                                        <td>
                                            <div class="dropdown">
                                                <select class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <div class="dropdown-menu dropdown-menu-right " x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-3px, 37px, 0px);">
                                                        <option>Present</option>
                                                        <option>Absent</option>
                                                    </div>      
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach                        
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h5 class="text-center">No Records found</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection