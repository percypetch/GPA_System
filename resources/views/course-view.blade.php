@extends('layouts.main')
@section('title', $course->course_code)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}} {{ $course->course_code }}

        <img src="{{ asset('/person/course.jpg') }}" class="card-img-top" alt="">
                <div class="text-center">
                <nav>
                @can('update', \App\Models\Course::class)
                    <br>
                    <ul class="list-group list-group-horizontal " style="display: inline-flex;">
                        <li class="list-group-item">
                            <a href="{{ route('course-update-form',['course' => $course->course_code,]) }}">Update</a> 
                        </li>
                        <li class="list-group-item">
                        <a href="{{ route('course-delete',['course' => $course->course_code,]) }}">Delete</a>
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
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 100px;"><b>Code</b></span>
            <input type="text"value="{{ $course->course_code }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 100px;"><b>Name</b></span>
            <input type="text"value="{{ $course->course_name }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 100px;"><b>Credit</b></span>
            <input type="text"value="{{ $course->credit }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 100px;"><b>Description</b></span>
            <textarea name="descriptions"class="form-control" style="background-color:white;" placeholder="Course descriptions." id="floatingTextarea2" style="height: 100px" disabled>{{ $course->descriptions }}</textarea>
            </div>
             @can('update', \App\Models\Course::class)
                    <br>
                    <table class="table text-center">
                        <thead>
                        <h5>Students in course.</h5>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Year</th>
                            </tr>
                        </thead>
                        @foreach($students as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('student-view', ['student' => $row->student_code,]) }}">
                                {{ $row->student_code }}</a></td>
                            <td> <a href="{{ route('student-view', ['student' => $row->student_code,]) }}">
                                {{ $row->student_name }}</a></td>
                            <td>{{ $row->student_gender }}</td>
                            <td>{{ $row->student_year }}</td>
                            </tr>
                        @endforeach  
                        </tbody>
                    </table>
                    @endcan
                    
                    <br>
                    <table class="table text-center">
                        <thead>
                        <h5>Teachers in course.</h5>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Phone</th>
                            </tr>
                        </thead>
                        @foreach($teachers as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('teacher-view', ['teacher' => $row->teacher_code,]) }}">
                                {{ $row->teacher_code }}</a></td>
                            <td> <a href="{{ route('teacher-view', ['teacher' => $row->teacher_code,]) }}">
                                {{ $row->teacher_name }}</a></td>
                            <td>{{ $row->teacher_gender }}</td>
                            <td>{{ $row->teacher_phone }}</td>
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