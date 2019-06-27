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
                    <form action="/master/{{$batch['id']}}/edit" method="post">
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection