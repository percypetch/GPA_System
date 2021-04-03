@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}} {{ $teacher->teacher_code }}
                <div class="text-center">
                <nav>
                    <br>
                    <ul class="list-group list-group-horizontal " style="display: inline-flex;">
                        <li class="list-group-item">
                            <a href="{{ route('teacher-update-form',['teacher' => $teacher->teacher_code,]) }}">Update</a> 
                        </li>
                        <li class="list-group-item">
                        <a href="{{ route('teacher-delete',['teacher' => $teacher->teacher_code,]) }}">Delete</a>
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


                    Code :: {{ $teacher->teacher_code }} <br>
                    Name ::{{ $teacher->teacher_name }} <br>
                    Gender ::{{ $teacher->teacher_gender }} <br>
                    Phone contact ::{{ $teacher->teacher_phone }} <br>
                    Courses :: TABLE for each
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



