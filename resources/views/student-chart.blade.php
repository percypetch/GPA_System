@extends('layouts.main')
@section('title', 'Student Chart')
@section('content')

<div class="card">
    <div class="card-header">
        <span><h1>Student Chart</h1></span>
    </div>
    <div class="card-body">
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>
</div>
<div class="rounded float-end">
    <div class="card">
        <div class="card-header">
            <span><h1>Student Data</h1></span>
        </div>
        <div class="card-body">
            <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Student Code</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Course Registed</th>
                            </tr>
                        </thead>
                        @foreach($tbl as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('student-view', ['student' => $row->student_code,]) }}">
                                {{ $row->student_code }}</a></td>
                            <td>{{ $row->student_name }}</td>
                            <td>{{ $row->courses_count }}</td>
                            </tr>
                        @endforeach  
                        </tbody>
             </table>
          </div>
    </div>
</div>
@endsection