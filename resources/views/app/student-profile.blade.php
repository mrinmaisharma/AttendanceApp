@extends('app.layout.std-profile-base')
@section('title', 'Profile')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3" src="/images/avatar/default.png" width="80" height="80" alt="">
                        <div class="media-body">
                            <h3 class="mb-0">{{$student['name']}}</h3>
                            <p class="text-muted mb-0">student</p>
                        </div>
                    </div>
                    
                    <div class="row mb-5">
                        <div class="col">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-content">
                                        <div class="stat-text">Attendance</div>
                                        <div class="stat-digit gradient-3-text">{{($total !=0 ) ? floor(round(($present/$total)*100)) : 0}}%</div>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar gradient-3" style="width: {{($total !=0 ) ? floor(round(($present/$total)*100)) : 0}}%;" role="progressbar"><span class="sr-only">{{($total !=0 ) ? floor(round(($present/$total)*100)) : 0}}% Attendance</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table>
                                <tr>
                                    <td><strong class="text-dark mr-4">Address</strong></td>
                                    <td width="25">:</td>
                                    <td>{{$student['address']}}</td>
                                </tr>
                                <tr>
                                    <td><strong class="text-dark mr-4">City</strong></td>
                                    <td width="25">:</td>
                                    <td>{{$student['city']}}</td>
                                </tr>
                                <tr>
                                    <td><strong class="text-dark mr-4">State</strong></td>
                                    <td width="25">:</td>
                                    <td>{{$student['state']}}</td>
                                </tr>
                                <tr>
                                    <td><strong class="text-dark mr-4">Pincode</strong></td>
                                    <td width="25">:</td>
                                    <td>{{$student['pincode']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 text-center">
                            <br>
                            <br>
                            <a href="/student/{{$student['id']}}/edit" class="btn btn-danger px-5">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr>
                            <td><strong class="text-dark mr-4">Username</strong></td>
                            <td width="25">:</td>
                            <td>{{$student['username']}}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">Phone Number</strong></td>
                            <td width="25">:</td>
                            <td>{{$student['phn_number']}}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">WhatsApp Number</strong></td>
                            <td width="25">:</td>
                            <td>{{$student['whatsapp_number']}}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">Email</strong></td>
                            <td width="25">:</td>
                            <td>{{$student['email']}}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">Institute</strong></td>
                            <td width="25">:</td>
                            <td>{{$student['institute']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Attendance Summary</h4>
                    <div>
                        <span style="color:inherit"><strong>Total classess: </strong></span>{{$total}} <br>
                        <span style="color:inherit"><strong>Present: </strong></span>{{$present}} <br>
                        <span style="color:inherit"><strong>Absent: </strong></span>{{$absent}} <br>
                    </div>
                    <div id="attendance-donut-chart">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection