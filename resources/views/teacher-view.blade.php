@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}} {{ $teacher->teacher_code }}
                @if($teacher->teacher_gender == 'Male')
                <img src="{{ asset('/person/teacher-male1.jpg') }}" class="card-img-top" alt="">
                @else
                <img src="{{ asset('/person/teacher-female1.jpg') }}" class="card-img-top" alt="">
                @endif
                <div class="text-center">
                <nav>
                @can('update', \App\Models\Teacher::class)
                    <br>
                    <ul class="list-group list-group-horizontal " style="display: inline-flex;">
                        <li class="list-group-item">
                            <a href="{{ route('teacher-add-course',['teacher' => $teacher->teacher_code,]) }}">Add Courses</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('teacher-update-form',['teacher' => $teacher->teacher_code,]) }}">Update</a> 
                        </li>
                        <li class="list-group-item">
                        <a href="{{ route('teacher-delete',['teacher' => $teacher->teacher_code,]) }}">Delete</a>
                        </li>
                    </ul>
                @endcan
                </nav>
                </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Code</b></span>
            <input type="text"value="{{ $teacher->teacher_code }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Name</b></span>
            <input type="text"value="{{ $teacher->teacher_name }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Gender</b></span>
            <input type="text"value="{{ $teacher->teacher_gender }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Phone</b></span>
            <input type="text"value="{{ $teacher->teacher_phone }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <br>
                    <table class="table text-center">
                        <thead>
                        <h5>Student in courses </h5>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            @can('update', \App\Models\Teacher::class)
                            <th scope="col">Number of Students</th>
                            <th scope="col">&nbsp</th>
                            @endcan
                            
                            </tr>
                        </thead>
                        @foreach($courses as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                {{ $row->course_code }}</a></td>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                {{ $row->course_name }}</a></td>
                            @can('update', \App\Models\Course::class)   
                            <td>{{ $row->students_count }}</td>
                            <td><a href="{{ route('teacher-remove-course', ['teacher' => $teacher->teacher_code,'course' => $row->course_code,]) }}">Remove</a></td>
                            @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



