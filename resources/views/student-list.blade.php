@extends('layouts.main')
@section('title', $title)
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}}
                <div class="text-center">
                <nav>
                    <br>
                    @can('update', \App\Models\Student::class)
                    <ul class="list-group list-group-horizontal " style="display: inline-flex;">
                        <li class="list-group-item">
                            <a href="/student/create">Key in Student Data</a> 
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

                    <div class="text-center">
                    <form action="{{ route('student-list') }}" method="get" >
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                    <input type="text" name="term" value="{{ $term }} " class="form-control" placeholder="Search" />
                    </div>
                    </form>
                    </div>


                    {{ $student->withQueryString()->links() }}

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gpa</th>
                            </tr>
                        </thead>
                        @foreach($gpa as $gpa)
                        @foreach($student as $row)
                        @if($row->student_code == $gpa->student_code)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('student-view', ['student' => $row->student_code,]) }}">
                                {{ $row->student_code }}</a></td>
                            <td> <a href="{{ route('student-view', ['student' => $row->student_code,]) }}">
                                {{ $row->student_name }}</a></td>
                            <td>{{ $gpa->gpa }}</td>
                            </tr>
                            @endif
                        @endforeach  
                        @endforeach
                        </tbody>
                    </table>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
