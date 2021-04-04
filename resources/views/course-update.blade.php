@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <button><a href="{{ route('course-view', ['course' => $course->course_code,]) }}">< Back</a></button>
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


    <form action="{{ route('course-update',['course' => $course->course_code,]) }}" method="post">
        @csrf
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Code</span>
                <input type="text" name="course_code" size="10" class="form-control" value="{{ old('course_code')?? $course->course_code }}" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            <input type="text" name="course_name" size="50" value="{{ old('course_name')?? $course->course_name  }}" class="form-control" required>
                </div>
        <div class="input-group mb-3" style="width: 250px;">
                <span class="input-group-text">Credit</span>
                <select id="credit" name="credit" class="form-control" style="width:10px;">
                @for($i=1 ; $i<=3 ; $i++)
                    @if(old('credit') == $i)
                        <option selected value="{{ $i }}">  
                        {{ $i }}
                        </option>              
                    @elseif($course->credit == $i && old('credit') == '')
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
        <div class="form-floating">
                <textarea name="descriptions"class="form-control" placeholder="Course descriptions." id="floatingTextarea2" style="height: 100px">{{ old('descriptions')?? $course->descriptions }}</textarea>
                </div><br>
        <div class="form-group row mb-0 justify-content-center">
                 <button type="submit" class="btn btn-success">Submit</button>&nbsp
        </div>
    </form>
    </main>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
