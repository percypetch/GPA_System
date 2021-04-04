@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <h5>{{$title}}</h5>
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


    <form action="{{ route('teacher-create') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Code</span>
                <input type="text" name="teacher_code" size="10" value="{{ old('teacher_code') }}" class="form-control" required>
                </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                <input type="text" name="teacher_name" size="50" value="{{ old('teacher_name') }}" class="form-control" required>
                </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Phone</span>
                <input type="text" name="teacher_phone" size="50" value="{{ old('teacher_phone') }}"  class="form-control" maxlength="12">
         </div>
         <div class="input-group mb-3" style="width: 250px;">
                <span class="input-group-text">Gender</span>
                <div class="form-control">
                    <input type="radio" id="teacher_gender" name="teacher_gender" value="Male"> Male </input>
                    <input type="radio" id="teacher_gender" name="teacher_gender" value="Female"> Female</input>
                </div>
            </div>
            <div class="form-group row mb-0 justify-content-center">
                 <button type="submit" class="btn btn-success">Submit</button>&nbsp
                <button class="btn btn-primary rounded float-end" type="reset">Reset</button>
        </div>
    </form>
    </main>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



