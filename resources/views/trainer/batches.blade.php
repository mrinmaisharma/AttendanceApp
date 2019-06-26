@extends('trainer.layout.base')
@section('title', 'Batches')


@section('content')

<div class="container-fluid batches">
    <div class="row">
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
                    <div class="row">
                        <div class="col-12">
                            <span class="card-text pull-left d-inline"><small class="text-muted">Start Date: {{$batch['start_date']}}</small></span>
                        </div>
                        <div class="col-12">
                            <br>
                        </div>
                        <div class="col-md-12 text-center">
                            <a href="/batch/{{$batch['id']}}/students" class="btn btn-sm mb-1 btn-rounded btn-outline-primary pull-left" style="margin: 0.1rem 0;">View Students</a>
                            <a href="/batch/{{$batch['id']}}/mark/attendance" class="btn btn-sm mb-1 btn-rounded btn-outline-danger pull-right" style="margin: 0.1rem 0;">Mark Attendance</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-md-12"><h3 class="text-center">No batch is assigned to you.</h3></div>
        @endif
    </div>
</div>

@endsection