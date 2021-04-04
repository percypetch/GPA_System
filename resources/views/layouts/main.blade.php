<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GPA System - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('student-list') }}">
                    <span class="text-warning">GPA System</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                        <ul class="navbar-nav mr-auto">
                        @can('update', \App\Models\Student::class)
                            <li><a href="/student"><span class="text-light">Student</span></a>&nbsp</li> 
                        @endcan

                            <li><a href="/teacher"><span class="text-light">Teacher</span></a>&nbsp</li> 


                            <li><a href="/course"><span class="text-light">Course</span></a></li>&nbsp  
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="/student">RegSystem</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/student">Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/teacher">Teacher</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/course">Course</a>
        </li>
       
      </ul>
      <div class="rounded float-end" style="width:100%; text-align:right;">
        Welcome! <span class="text-success">{{ \Auth::user()->name }}</span> &nbsp&nbsp&nbsp
        <a href="{{ route('logout') }}"><button type="button" class="btn btn-danger">Logout</button></a>
        </div>
    </div>
  </div>
</nav>
        

        <main class="py-4">

                <div style="display: block;
width: 800px;
margin-left:auto;
margin-right:auto;">
                    @error('input')
                    <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>Duplicated 'Code' number. Please use another number.</strong>
                        </div>
                    @enderror
                </div>
                
                @yield('content')
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.1/chart.min.js" charset="utf-8"></script>
    </div>
</body>
</html>
