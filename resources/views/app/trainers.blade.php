@extends('app.layout.base')
@section('title', 'Trainers')


@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Trainer Details</h4>
            <div class="table-responsive"> 
                <table class="table table-bordered table-striped verticle-middle">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Batch Alloted</th>
                        <th scope="col">Details</th>
                        </tr>
                    </thead>
                <tbody>
                    <tr>
                        <td>Nihal</td>
                        <td>123456789</td>
                        <td>nihal@gmail.com</td>
                        <td>Python</td>
                        <td><button type="button" class="btn mb-1 btn-rounded btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">View Details</button>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Modal body text goes here.</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Nihal</td>
                        <td>123456789</td>
                        <td>nihal@gmail.com</td>
                        <td>Python</td>
                        <td><button type="button" class="btn mb-1 btn-rounded btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">View Details</button>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Modal body text goes here.</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

@endsection