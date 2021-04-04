@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}} {{ $teacher->teacher_code }}
                <div class="text-center">
                <nav>
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


                    Code :: {{ $teacher->teacher_code }} <br>
                    Name ::{{ $teacher->teacher_name }} <br>
                    Gender ::{{ $teacher->teacher_gender }} <br>
                    Phone contact ::{{ $teacher->teacher_phone }} <br>
                    
                    <br><br><br><br><br><br>
                    <table class="table text-center">
                        <thead>
                        Courses
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Number of Students</th>
                            <th scope="col">&nbsp</th>
                            </tr>
                        </thead>
                        @foreach($courses as $row)
                        @foreach($cal_stu as $num)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                {{ $row->course_code }}</a></td>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                {{ $row->course_name }}</a></td>
                                
                            <td>{{ $num->stu_num }}</td>
                            <td><a href="{{ route('teacher-remove-course', ['teacher' => $teacher->teacher_code,'course' => $row->course_code,]) }}">Remove</a></td>
                            </tr>
                        @endforeach
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



