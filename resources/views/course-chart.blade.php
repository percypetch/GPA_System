@extends('layouts.main')
@section('title', 'Course Chart')
@section('content')
<div class="rounded float-start">
    <div class="card">
        <div class="card-header">
            <span><h1>Course Chart</h1></span>
        </div>
        <div class="card-body">
            {!! $chart->container() !!}
            {!! $chart->script() !!}
        </div>
    </div>
</div>
<div class="rounded float-end">
    <div class="card">
        <div class="card-header">
            <span><h1>Course Data</h1></span>
        </div>
        <div class="card-body">
            <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Students Enrolled</th>
                            <th scope="col">Teachers Teached</th>
                            </tr>
                        </thead>
                        @foreach($tbl as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                {{ $row->course_code }}</a></td>
                            <td>{{ $row->course_name }}</td>
                            <td>{{ $row->students_count }}</td>
                            <td>{{ $row->teachers_count }}</td>
                            </tr>
                        @endforeach  
                        </tbody>
             </table>
        </div>
    </div>
</div>


@endsection