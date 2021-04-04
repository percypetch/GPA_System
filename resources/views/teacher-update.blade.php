@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <button><a href="{{ route('teacher-view', ['teacher' => $teacher->teacher_code,]) }}">< Back</a></button>
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


                    <form action="{{ route('teacher-update',['teacher' => $teacher->teacher_code,]) }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Code</span>
                <input type="text" name="teacher_code" size="10" value="{{ old('teacher_code')??$teacher->teacher_code }}" class="form-control" require>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                <input type="text" name="teacher_name" size="50" value="{{ old('teacher_name')??$teacher->teacher_name }}" class="form-control" require>
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
                <input type="text" name="teacher_phone" size="50" value="{{ old('teacher_phone')??$teacher->teacher_phone }}">
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
            @if(old('teacher_gender')=='Male')
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Male" checked> Male </input>
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Female">Female</input>
            @elseif(old('teacher_gender')=='Female')
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Male" > Male </input>
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Female"checked>Female</input>
            @elseif($teacher->teacher_gender=='Male' )
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Male" checked> Male </input>
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Female">Female</input>
            @elseif($teacher->teacher_gender=='Female')
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Male" > Male </input>
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Female"checked>Female</input>
            @else
            <input type="radio" id="teacher_gender" name="teacher_gender" value="Male" > Male </input>
                <input type="radio" id="teacher_gender" name="teacher_gender" value="Female">Female</input>
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



