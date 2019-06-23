@extends('app.layout.base')
@section('title', 'Batches')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-black float-right style=">45<span style="font-size:0.5em;">Students</span></h3>
                    <h5 class="card-title">Batch A</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Trainer: Nihal Jaiswal</h6>
                    <p class="card-text d-inline"><small class="text-muted">Batch Start 15th August</small></p>
                    <a href="#" class="card-link float-right"><small>View Details</small></a>
                    <button type="button" class="btn mb-1 btn-outline-primary"style="margin-top:1em; font-size:0.8em;">Assign Trainer</button>
                    <button type="button" class="btn mb-1 btn-outline-primary float-right"style="margin-top:1em; font-size:0.8em;">+ Students</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection