<!DOCTYPE html>
<html lang="en">
<head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
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
        </nav><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
            <form action="{{ route('authenticate') }}" method="post">
                @csrf
                        @error('email')
                        <div>{{ $message }}</div>
                        @enderror
                        <div class="form-group row">
                            E-mail <input type="text" name="email" class="form-control" srequire/>
                        </div>
                        <div class="form-group row">
                            Password <input type="password" name="password" class="form-control" require/>
                            </div>
                            <div class="form-group row mb-0 justify-content-center">
                    <button type="submit" class="btn btn-primary">Login</button>&nbsp&nbsp&nbsp
                    
            </form>
            <form action="{{ route('authenticate') }}" method="post">
                 @csrf
                 
                    <button type="submit" class="btn btn-secondary">Guest Login</button>
                   
                        <input type="hidden" name="email" value="guest@gpa.com" />
                        <input type="hidden" name="password" value="1234" />
                    </div>
            </form>
            
            </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
