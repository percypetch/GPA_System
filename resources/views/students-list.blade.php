<table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">&nbsp</th>
                            </tr>
                        </thead>
                        @foreach($student as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('student-view', ['student' => $row->student_code,]) }}">
                                {{ $row->student_code }}</a></td>
                            <td> <a href="{{ route('student-view', ['student' => $row->student_code,]) }}">
                                {{ $row->student_name }}</a></td>
                            <td>{{ $row->student_gpa }}</td>
                            <td>Hi</td>
                            </tr>
                        @endforeach  
                        </tbody>
</table>