@extends('app.layout.base')
@section('title', 'Edit Batch')

@section('data-page-id', 'editBatch')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('includes.form_alert')
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h3 style="color: inherit;" class="text-center"><strong>Edit Batch</strong></h4>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="/batch/{{$batch['id']}}/edit" method="post">
                        <input type="hidden" name="token" value="{{\App\CLasses\CSRFToken::_token()}}">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="batch_name">Batch Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" value="{{$batch['name']}}" autocomplete="off" class="form-control" id="batch_name" name="name" required placeholder="Batch Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="start_date">Start Date<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input style="padding-left:1rem;" type="text" value="{{$batch['start_date']}}" autocomplete="off" class="form-control datepicker" name="start_date" id="startDate" placeholder="yyyy-mm-dd" required>
                                    <span class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-confirm-password">End Date
                            </label>
                            <div class="col-lg-6">
                            <div class="input-group">
                                    <input style="padding-left:1rem;" type="text" value="{{$batch['end_date']}}" autocomplete="off" class="form-control datepicker" name="end_date" id="endDate" placeholder="yyyy-mm-dd">
                                    <span class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-danger btn-sm pull-left" data-toggle="modal" data-target="#deleteBatchModal">
                                <i data-toggle="tooltip" title="Delete Batch" class="icon-trash"></i>    
                            </button>
                        </div>
                    </div>
                    <!-- Delete Modal -->
                    <div id="deleteBatchModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <form action="/batch/{{$batch['id']}}/delete" method="post">
                                <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color:inherit;"><strong>Delete Batch</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this Batch?<br/>This will also delete all the student assigned to this batch.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger btn-sm">Yes</button>
                                        <button type="button" class="btn btn-sm" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection