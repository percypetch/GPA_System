@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <button><a href="{{ route('teacher-view', ['teacher' => $teacher->teacher_code,]) }}">< Back</a></button>
                <br />{{$title}}
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


                    <form action="{{ route('teacher-add-course', ['teacher' => $teacher->teacher_code,]) }}" method="post">
        @csrf
            <table class="table">
                <thed>
                    <tr>
                        <th class="bg">Code</th>
                        <th class="bg">Name</th>
                        <th class="bg">Number of Student</th>
                        <th class="bg" >&nbsp;</th>
                    <tr>
                </thed>

                <tbody>
                    @foreach($courses as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                {{ $row->course_code }}</a></td>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                {{ $row->course_name }}</a></td>
                            <td>$cal_stu</td>
                            <td class="normal"width=20px >
                                <button type="submit" name="course" value="{{ $row->id }}">Add</button>
                                <input type="hidden" name="courseCode" value="{{ $row->course_code }}">
                            </td>
                            </tr>

                        @endforeach  
                </tbody>
            </table>
        </form>
    </main>
    </main>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



