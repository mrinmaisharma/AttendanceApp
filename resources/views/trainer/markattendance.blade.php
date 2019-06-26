@extends('trainer.layout.base')
@section('title', 'Mark Attendance')


@section('content')

<div class="container-fluid">
    <form action="/batch/{{$batch['id']}}/mark/attendance" method="post">
        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
        <input type="hidden" name="batch_id" value="{{$batch['id']}}">
        <div class="row">
            <div class="col-md-12">
                @include('includes.form_alert')
            </div>
            <div class="col-md-4">
                <label>
                    Date of Attendance
                    <div class="input-group">
                        <input type="text" value="{{date('Y-m-d', time())}}" style="padding-left:1rem" autocomplete="off" class="form-control datepicker" name="date_of_attd" id="startDate" placeholder="yyyy-mm-dd" required>
                        <span class="input-group-append">
                            <span class="input-group-text">
                                <i class="mdi mdi-calendar-check"></i>
                            </span>
                        </span>
                    </div>
                </label>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><strong>Batch:</strong> {{$batch['name']}}</h4>
                        <div class="table-responsive"> 
                            @if(count($students))
                            <div class="table-responsive">
                                <table id="myDataTable" class="table table-hover table-bordered zero-configuration verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#Id</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{$student['id']}}</td>
                                            <td>{{$student['username']}}</td>
                                            <td>{{$student['name']}}</td>
                                            <td class="text-center">
                                                <select style="padding: 0.5rem; height: 1rem !important; min-height: 0;" name="status{{$student['id']}}">
                                                    <option value="present">Present</option>
                                                    <option value="absent">Absent</option>
                                                </select>
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
                        <div>
                            <br>
                            <br>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection