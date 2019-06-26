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
                                            <button type="button" class="btn mb-1 btn-rounded btn-primary" data-toggle="modal" data-target="#view-student{{$student['id']}}">
                                                View Details
                                            </button>
                                            <div class="modal fade" id="view-student{{$student['id']}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="color:inherit;"><strong>{{$student['name']}}</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body row">
                                                            <div class="col-11">
                                                                <table class="table" style="background-color: transparent;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><strong>Full Name</strong></td>
                                                                            <td>{{$student['name']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Username</strong></td>
                                                                            <td>{{$student['username']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Batch</strong></td>
                                                                            <td>{{$student['batch']->name}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Phone Number</strong></td>
                                                                            <td>{{$student['phn_number']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>WhatsApp Number</strong></td>
                                                                            <td>{{($student['whatsapp_number'] == null) ? '--' : $student['whatsapp_number']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Email</strong></td>
                                                                            <td>{{$student['email']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Insititue</strong></td>
                                                                            <td>{{$student['institute']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Address</strong></td>
                                                                            <td>{{($student['address'] == null) ? '--' : $student['address']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>City</strong></td>
                                                                            <td>{{($student['city'] == null) ? '--' : $student['city']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>State</strong></td>
                                                                            <td>{{($student['state'] == null) ? '--' : $student['state']}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Pincode</strong></td>
                                                                            <td>{{($student['pincode'] == null) ? '--' : $student['pincode']}}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
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