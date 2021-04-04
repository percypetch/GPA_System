@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
{{$title}}
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


                    <form action="{{ route('student-update',['student' => $student->student_code,]) }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Code</span>
                <input type="text" name="student_code" size="10" class="form-control" value="{{ old('student_code')??$student->student_code }}" require>
                </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" >Name</span>
                <input type="text" name="student_name" size="50" class="form-control" value="{{ old('student_name')??$student->student_name }}" require>
                </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Phone</span>
                <input type="text" name="student_phone" class="form-control" size="50" value="{{ old('student_phone')??$student->student_phone }}">
                <span class="input-group-text">Year</span>
                <select id="student_year" name="student_year" class="form-control" style="width:10px;">
                @for($i=1 ; $i<=4 ; $i++)
                    @if(old('student_year') == $i)
                        <option selected value="{{ $i }}">  
                        {{ $i }}
                        </option>              
                    @elseif($student->student_year == $i && old('student_year') == '')
                        <option selected value="{{ $i }}">  
                        {{ $i }}
                        </option>
                    @else
                        <option value="{{ $i }}">  
                        {{ $i }}
                        </option>
                    @endif
                @endfor
                </select>
                </div>
        <div class="input-group mb-3" style="width: 250px;">
                <span class="input-group-text">Gender</span>
                <div class="form-control">
            @if(old('student_gender')=='Male')
                <input type="radio" id="student_gender" name="student_gender" value="Male" checked> Male </input>
                <input type="radio" id="student_gender" name="student_gender" value="Female"> Female</input>
            @elseif(old('student_gender')=='Female')
                <input type="radio" id="student_gender" name="student_gender" value="Male" > Male </input>
                <input type="radio" id="student_gender" name="student_gender" value="Female"checked> Female</input>
            @elseif($student->student_gender=='Male' )
                <input type="radio" id="student_gender" name="student_gender" value="Male" checked> Male </input>
                <input type="radio" id="student_gender" name="student_gender" value="Female"> Female</input>
            @elseif($student->student_gender=='Female')
                <input type="radio" id="student_gender" name="student_gender" value="Male" > Male </input>
                <input type="radio" id="student_gender" name="student_gender" value="Female"checked> Female</input>
            @else
            <input type="radio" id="student_gender" name="student_gender" value="Male" > Male </input>
                <input type="radio" id="student_gender" name="student_gender" value="Female"> Female</input>
            @endif
            </div>
            </div>
        <div class="form-group row mb-0 justify-content-center">
                 <button type="submit" class="btn btn-warning">Update</button>&nbsp
         </div>
    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



