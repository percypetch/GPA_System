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
                            <a href="">Update</a> 
                        </li>

                        <li class="list-group-item">
                        <a href="">Delete</a>
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


                    <form action="{{ route('student-create') }}" method="post">
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
                <input type="text" name="code" size="50" value="{{ old('student_code') }}">
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
                <input type="text" name="name" size="50" value="{{ old('student_name') }}">
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
                <select id="year" name="year">
                @for($i=1 ; $i<=4 ; $i++)
                    <option value="$i" {{ ($student->year == old('year'))? ' selected' : '' }} >  
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
            <input type="checkbox" id="gender" name="gender" value="Male">Male </input>
            <input type="checkbox" id="gender" name="gender" value="Female">Female</input>
            </td>
        </tr>

        
        <tr>
            <td>

            </td>
            <td>

            </td>
            <td class="center">
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



