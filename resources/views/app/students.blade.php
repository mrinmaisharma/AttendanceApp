@extends('app.layout.base')
@section('title', 'Students')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('includes.form_alert')
        </div>
        <div class="col-md-12">
            <a href="/master/student/add" class="btn mb-1 btn-rounded btn-outline-info">
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
                                        <th scope="col">Action</th>
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
                                            <a href="/student/{{$student['id']}}/profile" data-toggle="tooltip" title="View Details">
                                                <span class="btn btn-primary mr-1 btn-rounded btn-sm" data-toggle="modal" data-target="#viewStudentModal{{$student['id']}}">
                                                    <i class="icon-eye"></i>
                                                </span>
                                            </a>
                                            <a href="/student/{{$student['id']}}/edit" data-toggle="tooltip" title="Edit">
                                                <span class="btn btn-warning mr-1 btn-rounded btn-sm" style="color:#fff">
                                                    <i class="icon-note"></i>
                                                </span>
                                            </a>
                                            <span data-toggle="tooltip" title="Delete">
                                                <span class="btn btn-danger btn-rounded btn-sm" data-toggle="modal" data-target="#deleteStudentModal{{$student['id']}}">
                                                    <i class="icon-trash"></i>
                                                </span>
                                            </span>

                                            <!-- Delete Modal -->
                                            <div id="deleteStudentModal{{$student['id']}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <form action="/student/{{$student['id']}}/delete" method="post">
                                                        <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color:inherit;"><strong>Delete Student</strong></h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this student?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger btn-sm">Yes</button>
                                                                <button type="button" class="btn btn-sm" data-dismiss="modal">No</button>
                                                            </div>
                                                        </div>
                                                    </form>
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