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
                        <li class="list-group-item">
                            <a href="{{ route('student-chart') }}">Student Chart</a>
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


<nav aria-label="Page navigation example">
{{ $student->withQueryString()->links() }}
</nav>
<div style="
display: block;
width: 1000px;
margin-left:auto;
margin-right:auto;
padding-left: 50px;
">

  @foreach($student as $row)

<div class="card img-thumbnail " style="width: 18rem; display:inline-block;">
    @if($row->student_gender == 'Male')
      <img src="{{ asset('/person/male1.jpg') }}" class="card-img-top" alt="">
    @else
        <img src="{{ asset('/person/female1.jpg') }}" class="card-img-top" alt="">
    @endif
      <div class="card-body">
          <h5 class="card-title"><a href="{{ route('student-view', ['student' => $row->student_code,]) }}">
          {{ $row->student_code }}</a></h5>
          <p class="card-text"><a href="{{ route('student-view', ['student' => $row->student_code,]) }}">{{ $row->student_name }}</a></p>
          <p class="card-text">Year : {{ $row->student_year }}</p>
          <a href="{{ route('student-view', ['student' => $row->student_code,]) }}" class="btn btn-primary">More Detail</a>
      </div>
  </div>
  @endforeach  
 </div>

@endsection
