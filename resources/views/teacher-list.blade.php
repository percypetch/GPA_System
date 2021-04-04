@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}}

                <div class="text-center">
                <nav>
                @can('update', \App\Models\Teacher::class)
                    <br>
                    <ul class="list-group list-group-horizontal " style="display: inline-flex;">
                        <li class="list-group-item">
                            <a href="/teacher/create">Key in Teacher Data</a> 
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('teacher-chart') }}">Teacher Chart</a> 
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
                    <form action="{{ route('teacher-list') }}" method="get">
                    <label><b>Search </b><input type="text" name="term" value="{{ $term }}" /></label>
                    </form>
                    </div>

                    {{ $teacher->withQueryString()->links() }}

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Gender</th>
                            </tr>
                        </thead>
                        @foreach($teacher as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('teacher-view', ['teacher' => $row->teacher_code,]) }}">
                                {{ $row->teacher_code }}</a></td>
                            <td> <a href="{{ route('teacher-view', ['teacher' => $row->teacher_code,]) }}">
                                {{ $row->teacher_name }}</a></td>
                            <td>{{ $row->teacher_phone }}</td>
                            <td>{{ $row->teacher_gender }}</td>
                            </tr>
                        @endforeach  
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
