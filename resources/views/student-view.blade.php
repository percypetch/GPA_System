@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}} {{ $student->student_code }}
                <div class="text-center">
                <nav>
                    <br>
                    <ul class="list-group list-group-horizontal " style="display: inline-flex;">
                        <li class="list-group-item">
                        <a href="{{ route('student-add-course',['student' => $student->student_code,]) }}">Add Courses</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('student-update-form',['student' => $student->student_code,]) }}">Update</a> 
                        </li>
                        <li class="list-group-item">
                        <a href="{{ route('student-delete',['student' => $student->student_code,]) }}">Delete</a>
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


                    Code :: {{ $student->student_code }} <br>
                    Name ::{{ $student->student_name }} <br>
                    Gender ::{{ $student->student_gender }} <br>
                    Year ::{{ $student->student_year }} <br>
                    Phone contact ::{{ $student->student_phone }} <br>
                    GPA ::{{ $student->student_gpa }} <br>
                    Courses :: TABLE for each
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



