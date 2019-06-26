@extends('app.layout.base')
@section('title', 'Batches')


@section('content')

<div class="container-fluid batches">
    <div class="row">
        <div class="col-md-12">
            @include('includes.form_alert')
        </div>
        @if(count($batches))
        @foreach($batches as $batch)
        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <span class="float-right total-students text-pale-sky">
                        <i class="fa fa-users mr-3"></i>
                        <span class="label gradient-8 btn-rounded">{{count($batch['students'])}}</span>
                    </span>
                    <h5 class="card-title" style="color:inherit"><strong>{{$batch['name']}}</strong></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Trainer: {{($batch['trainer'] == null) ? "Not Assigned" : $batch['trainer']->name}}</h6>
                    <div class="row">
                        <div class="col-12">
                            <span class="card-text pull-left d-inline"><small class="text-muted">Start Date: {{$batch['start_date']}}</small></span>
                            <a href="#" class="badge badge-pill badge-primary pull-right" data-toggle="modal" data-target="#view-batch{{$batch['id']}}" style="margin: 0.1rem 0;">View Details</a>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn mb-1 btn-rounded btn-outline-info" data-toggle="modal" data-target="#assignTrainerModal{{$batch['id']}}" style="margin-top:1em; font-size:0.8rem;">Assign Trainer</button>
                            <a href="/master/student/add?batch_id={{$batch['id']}}" class="btn mb-1 btn-rounded btn-outline-primary float-right"style="margin-top:1em; font-size:0.8rem;">+ Students</a>
                        </div>
                    </div>
                    <!-- View Details Modal -->
                    <div class="modal fade" id="view-batch{{$batch['id']}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="color:inherit;"><strong>{{$batch['name']}}</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                    </button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-11">
                                        <table class="table" style="background-color: transparent;">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Name</strong></td>
                                                    <td>{{$batch['name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Start date</strong></td>
                                                    <td>{{$batch['start_date']}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>End Date</strong></td>
                                                    @if($batch['end_date'] == null)
                                                    <td>--</td>
                                                    @else
                                                    <?php
                                                        $end = new \Carbon\Carbon($batch['end_date']);
                                                        $batch['end_date'] = $end->format("Y-m-d"); 
                                                     ?>
                                                    <td>{{$batch['end_date']}}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Trainer</strong></td>
                                                    <td>{{($batch['trainer'] == null) ? '--' : $batch['trainer']->name}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="/batch/{{$batch['id']}}/edit" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Assign Trainer Modal -->
                    <div class="modal fade" id="assignTrainerModal{{$batch['id']}}" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="/batch/{{$batch['id']}}/assign/trainer" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="collor:inherit"><strong>Assign Trainer</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="token" value="{{\App\CLasses\CSRFToken::_token()}}">
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1 col-form-label" for="Trainer">
                                                Trainer <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control" name="trainer_id" id="trainer" required>
                                                    <option value="" selected>---Select Trainer---</option>
                                                    @foreach(\App\Models\Trainer::all() as $trainer)
                                                        <option value="{{$trainer['id']}}">{{$trainer['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Assign</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-md-12"><h3 class="text-center">No batch created</h3></div>
        @endif
    </div>
</div>

@endsection