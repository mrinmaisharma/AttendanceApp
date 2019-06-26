@extends('trainer.layout.base')
@section('title', 'Students')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('includes.form_alert')
        </div>
        <div class="col-md-12">
            <a href="/student/add" class="btn mb-1 btn-rounded btn-outline-info">
                <i class="fa fa-plus"></i> Add Student
            </a>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Student Details</h4>
                    <div class="table-responsive"> 
                        @if(count($students))
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-hover table-bordered zero-configuration table-striped verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Phone No.</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Batch Alloted</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{$student['name']}}</td>
                                        <td>{{$student['phn_number']}}</td>
                                        <td>{{$student['email']}}</td>
                                        <td>{{$student['batch']['name']}}</td>
                                        <td>
                                            <a href="/student/{{$student['id']}}/profile" class="btn mb-1 btn-rounded btn-primary">
                                                View Details
                                            </a>
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