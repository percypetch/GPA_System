@extends('layouts.main')
@section('title',$title)
@section('content')
                    Code :: {{ $student->student_code }} <br>
                    Name ::{{ $student->student_name }} <br>
                    GPA ::{{ $student->student_gpa }} <br>
                    Courses :: TABLE for each
@endsection