@extends('app.layout.base')
@section('title', 'Trainers')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('includes.form_alert')
        </div>
        <div class="col-md-12">
            <a href="/master/trainer/add" class="btn mb-1 btn-rounded btn-outline-info">
                <i class="fa fa-plus"></i> Add Trainer
            </a>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Trainer Details</h4>
                    <div class="table-responsive"> 
                        @if(count($trainers))
                        <table class="zero-configuration table table-hover table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Phone No.</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trainers as $trainer)
                                <tr>
                                    <td>{{$trainer['name']}}</td>
                                    <td>{{$trainer['phn_number']}}</td>
                                    <td>{{$trainer['email']}}</td>
                                    <td>
                                        <span data-toggle="tooltip" title="View Details">
                                            <span class="btn btn-primary mr-1 btn-rounded btn-sm" data-toggle="modal" data-target="#viewTrainerModal{{$trainer['id']}}">
                                                <i class="icon-eye"></i>
                                            </span>
                                        </span>
                                        <a href="/trainer/{{$trainer['id']}}/edit" data-toggle="tooltip" title="Edit">
                                            <span class="btn btn-warning mr-1 btn-rounded btn-sm" style="color:#fff">
                                                <i class="icon-note"></i>
                                            </span>
                                        </a>
                                        <span data-toggle="tooltip" title="Delete">
                                            <span class="btn btn-danger btn-rounded btn-sm" data-toggle="modal" data-target="#deleteTrainerModal{{$trainer['id']}}">
                                                <i class="icon-trash"></i>
                                            </span>
                                        </span>
                                        <!-- View Details Modal -->
                                        <div class="modal fade" id="viewTrainerModal{{$trainer['id']}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" style="color:inherit;"><strong>{{$trainer['name']}}</strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div class="col-11">
                                                            <table class="table" style="background-color: transparent;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td><strong>Full Name</strong></td>
                                                                        <td>{{$trainer['name']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Username</strong></td>
                                                                        <td>{{$trainer['username']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Phone Number</strong></td>
                                                                        <td>{{$trainer['phn_number']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>WhatsApp Number</strong></td>
                                                                        <td>{{($trainer['whatsapp_number'] == null) ? '--' : $trainer['whatsapp_number']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Email</strong></td>
                                                                        <td>{{$trainer['email']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Address</strong></td>
                                                                        <td>{{($trainer['address'] == null) ? '--' : $trainer['address']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>City</strong></td>
                                                                        <td>{{($trainer['city'] == null) ? '--' : $trainer['city']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>State</strong></td>
                                                                        <td>{{($trainer['state'] == null) ? '--' : $trainer['state']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Pincode</strong></td>
                                                                        <td>{{($trainer['pincode'] == null) ? '--' : $trainer['pincode']}}</td>
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
                                        <!-- Delete Modal -->
                                        <div id="deleteTrainerModal{{$trainer['id']}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <!-- Modal content-->
                                                <form action="/trainer/{{$trainer['id']}}/delete" method="post">
                                                    <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="color:inherit;"><strong>Delete Trainer</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this Trainer?</p>
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