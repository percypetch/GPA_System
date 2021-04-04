@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <button><a href="/course">< Back</a></button>
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


    <form action="{{ route('course-create') }}" method="post">
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
                <input type="text" name="course_code" size="10" value="{{ old('course_code') }}" required>
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
                <input type="text" name="course_name" size="50" value="{{ old('course_name') }}" required>
            </td>
        </tr>
        <tr>
            <td>
                <span class=""><b>Credit</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
                <select id="credit" name="credit">
                @for($i=1 ; $i<=3 ; $i++)
                    <option value="{{ $i }}">  
                       {{ $i }}
                    </option>
                @endfor
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <span class=""><b>*Description</b></span>
            </td>
            <td>
                <span class = "bluecolor">:: </span>
            </td>
            <td>
                <textarea name="descriptions" id="" cols="30" rows="5">{{ old('descriptions') }}</textarea>
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
