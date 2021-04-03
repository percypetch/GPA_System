@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{$title}}
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


                    <form action="{{ route('student-add-course', ['student' => $student->student_code,]) }}" method="post">
        @csrf
            <table>
                <thed>
                    <tr>
                        <th class="bg">Code</th>
                        <th class="bg">Name</th>
                        <th class="bg">Credit</th>
                        <th class="bg" >&nbsp;</th>
                    <tr>
                </thed>

                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <th>
                                <span class="underline">{{ $course->course_code }}</span>
                            </th>
                            <td class="normal" width=400px>{{ $course->course_name }}</td>
                            <td class="normal"  width=200px>{{ $course->credit }}</td>
                            <td class="normal"width=20px >
                                <button type="submit" name="shop" value="{{ $course->course_id }}">Add</button>
                                <input type="hidden" name="shopCode" value="{{ $course->course_code }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </main>
    </main>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



