@extends('app.layout.base')
@section('title', 'Dashboard')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Batches</h3>
                    <div class="d-inline-block">
                        <br>
                        <h2 class="text-white">0</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="icon-grid"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-7">
                <div class="card-body">
                    <h3 class="card-title text-white">Trainers</h3>
                    <div class="d-inline-block">
                        <br>
                        <h2 class="text-white">0</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thought of the day</h5>
                    <p class="card-text" id="quoteOfTheDay">
                    This is a wider card with supporting text and below as a natural lead-in to the additional content. 
                    This content is a little bit longer.
                    <br>
                    <span class="pull-right"><strong>~ Author</strong></span>
                    </p>
                    <p class="card-text d-inline"><small class="text-muted">quotes powered by: <a href="https://theysaiso.com">TheySaidSo</a></small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    
    </div>
</div>

@endsection