@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}} {{ $student->student_code }}
                <div class="text-center">
                <nav>
                @can('update', \App\Models\Student::class)
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


                    Code :: {{ $student->student_code }} <br>
                    Name ::{{ $student->student_name }} <br>
                    Gender ::{{ $student->student_gender }} <br>
                    Year ::{{ $student->student_year }} <br>
                    Phone contact ::{{ $student->student_phone }} <br>
                    <br>


                    
                    
                    
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                    <table class="table text-center">
                        <thead>
                        Courses
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Grade</th>
                            @can('update', \App\Models\Student::class)
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
                            <td>{{ $row->credit }}</td>
                            @can('update', \App\Models\Student::class)
                            <td><a href="{{ route('student-remove-course', ['student' => $student->student_code,'course' => $row->course_code,]) }}">Remove</a></td>
                            @endcan
                            </tr>
                        @endforeach  
                        </tbody>
                    </table>

                    <table class="table text-center">
                        <thead>
                        Grade
                            <tr>
                            <th scope="col">C_id</th>
                            <th scope="col">Name</th>
                            <th scope="col">S_id</th>
                            <th scope="col">Grade</th>
                            @can('update', \App\Models\Student::class)
                            <th scope="col">&nbsp</th>
                            @endcan
                            </tr>
                        </thead>
                        @foreach($courses as $row)
                        @foreach($course_student as $num)
                        @if($student->student_code == $row->student_code)
                        <tbody>
                            <tr>
                            <td>  {{ $row->course_code }} </td>
                            <td>  {{ $row->course_name }} </td>
                            <td>  </td>
                            
                            <td>
                            {{$num->grade}}
                            </td>
                        </form>
                            @can('update', \App\Models\Student::class)
                            <td>Remove</td>
                            @endcan
                            </tr>
                        @endif
                        @endforeach
                        @endforeach  
                        </tbody>
                    </table>
                    <form action="{{ route('student-view', ['student' => $student->student_code]) }}" method="get">
                                <select id="student_year" name="student_year">
                                    <option value=NULL> </option> 
                                    <option value="4">A</option>
                                    <option value="3.5">B+</option>
                                    <option value="3">B</option>
                                    <option value="2.5">C+</option>
                                    <option value="2">C</option>
                                    <option value="1.5">D+</option>
                                    <option value="1">D</option>
                                    <option value="0">F</option>    
                                </select>

                         

                    GPA ::{{ $student->student_gpa }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



