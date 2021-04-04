@extends('layouts.main')
@section('title', $title)
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                <div class="text-center">
                <nav>
                @can('update', \App\Models\Course::class)
                    <br>
                    <ul class="list-group list-group-horizontal " style="display: inline-flex;">
                        <li class="list-group-item">
                            <a href="{{ route('course-create-form') }}">Key in Course Data</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('course-chart') }}">Course Chart</a>
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


                </div>
            </div>
        </div>
    </div>
</div><br>
<div style="
display: block;
width: 1000px;
margin-left:auto;
margin-right:auto;
padding-left: 50px;
">
{{ $course->withQueryString()->links() }}

@foreach($course as $row)

    <div class="card img-thumbnail " style="width: 18rem; display:inline-block;">
        <img src="{{ asset('/person/course.jpg') }}" class="card-img-top" alt="">
     
        <div class="card-body">
            <h5 class="card-title"><a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
        {{ $row->course_code }}</a></h5>
            <p class="card-text"><a href="{{ route('course-view', ['course' => $row->course_code,]) }}">
        {{ $row->course_name }}</a></p>
        <p style="width: 170px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;">{{ $row->descriptions }}</p>
            <a href="{{ route('course-view', ['course' => $row->course_code,]) }}" class="btn btn-primary">More Detail</a>
            
        </div>
    </div>
@endforeach
</div>  
@endsection
