@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}} {{ $student->student_code }}
                @if($student->student_gender == 'Male')
                <img src="{{ asset('/person/male1.jpg') }}" class="card-img-top" alt="">
                @else
                <img src="{{ asset('/person/female1.jpg') }}" class="card-img-top" alt="">
                @endif
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
                    <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Code</b></span>
            <input type="text"value="{{ $student->student_code }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Name</b></span>
            <input type="text"value="{{ $student->student_name }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Gender</b></span>
            <input type="text"value="{{ $student->student_gender }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Year</b></span>
            <input type="text"value="{{ $student->student_year }}" class="form-control" style="background-color:white;" disabled>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 80px;"><b>Phone</b></span>
            <input type="text"value="{{ $student->student_phone }}" class="form-control" style="background-color:white;" disabled>
            </div><br>

                    <table class="table text-center">
                        <thead>
                        <h5>Courses Registed</h5>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Credit</th>
                            @can('update', \App\Models\Student::class)
                            <th scope="col">&nbsp</th>
                            @endcan
                            </tr>
                        </thead>
                        @php
                            $sum = 0;
                        @endphp
                        @foreach($courses as $row)
                            @php
                            $sum+=$row->credit ;
                            @endphp
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                <b>{{ $row->course_code }}</b></a></td>
                            <td> <a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
                                {{ $row->course_name }}</a></td>
                            <td>{{ $row->credit }}</td>
                            @can('update', \App\Models\Student::class)
                            <td><a href="{{ route('student-remove-course', ['student' => $student->student_code,'course' => $row->course_code,]) }}"><button type="button" class="btn btn-danger">Remove</button></a></td>
                            @endcan
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            @if($sum != 0)
                            <td><b><u>{{$sum}}</u></td>
                            @endif
                            <td></td>
                        </tr>  
                        </form>
                        </tbody>
                    </table>
                
                       
                            
                        
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



