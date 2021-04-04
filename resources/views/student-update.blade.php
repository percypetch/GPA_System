@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <button><a href="{{ route('student-view', ['student' => $student->student_code,]) }}">< Back</a></button>
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


                    <form action="{{ route('student-update',['student' => $student->student_code,]) }}" method="post">
        @csrf

        <table class="tablecenter normal alignRight">
        <tr>
            <td>
                <span class=""><b>Code</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
                <input type="text" name="student_code" size="10" value="{{ old('student_code')??$student->student_code }}" require>
            </td>
        </tr>

        <tr>
            <td>
                <span class=""><b>Name</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
                <input type="text" name="student_name" size="50" value="{{ old('student_name')??$student->student_name }}" require>
            </td>
        </tr>

        <tr>
            <td>
                <span class=""><b>Phone</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
                <input type="text" name="student_phone" size="50" value="{{ old('student_phone')??$student->student_phone }}">
            </td>
        </tr>

        <tr>
            <td>
                <span class=""><b>Year</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
                <select id="student_year" name="student_year" >
                @for($i=1 ; $i<=4 ; $i++)
                    @if($student->student_year ==  $i)
                        <option selected value="{{ $i }}" {{ ($student->student_year == old('student_year'))? ' selected' : '' }} >  
                        {{ $i }}
                        </option>
                    @else
                        <option  value="{{ $i }}" {{ ($student->student_year == old('student_year'))? ' selected' : '' }} >  
                        {{ $i }}
                        </option>
                    @endif
                @endfor
                </select>
            </td>
        </tr>

        <tr>
            <td>
                <span class=""><b>Gender</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
            @if($student->student_gender=='Male')
                <input type="radio" id="student_gender" name="student_gender" value="Male" checked> Male </input>
                <input type="radio" id="student_gender" name="student_gender" value="Female">Female</input>
            @elseif($student->student_gender=='Female')
                <input type="radio" id="student_gender" name="student_gender" value="Male" > Male </input>
                <input type="radio" id="student_gender" name="student_gender" value="Female"checked>Female</input>
            @else
            <input type="radio" id="student_gender" name="student_gender" value="Male" > Male </input>
                <input type="radio" id="student_gender" name="student_gender" value="Female">Female</input>
            @endif
            </td>
        </tr>

        
        <tr>
            <td>



            </td>
            <td>

            </td>
            <td class="text-center">
            <input type="submit">
            </td>
        </tr>
        </table>
    </form>
    </main>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



