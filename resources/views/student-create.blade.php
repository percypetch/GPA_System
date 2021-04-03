@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}}
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


    <form action="{{ route('student-create') }}" method="post">
        @csrf

        <table class="tablecenter normal alignRight">
        <tr>
            <td>
                <span class=""><b>*Code</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
                <input type="text" name="student_code" size="10" value="{{ old('student_code') }}" required>
            </td>
        </tr>

        <tr>
            <td>
                <span class=""><b>*Name</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
                <input type="text" name="student_name" size="50" value="{{ old('student_name') }}" required>
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
                <input type="text" name="student_phone" size="50" value="{{ old('student_phone') }}" maxlength="12">
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
                <select id="student_year" name="student_year">
                @for($i=1 ; $i<=4 ; $i++)
                    <option value="{{ $i }}">  
                       {{ $i }}
                    </option>
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
            <input type="radio" id="student_gender" name="student_gender" value="Male"> Male </input>
            <input type="radio" id="student_gender" name="student_gender" value="Female">Female</input>
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



