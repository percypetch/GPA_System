<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Courses;
use App\Models\Teacher;

class StudentController extends Controller
{
    private $title = 'Student';

    public function __construct() {
        $this->middleware('auth');
    }
    
    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Student::orderBy('student_code')/*->withCount('shops')*/;
        $term = (key_exists('term', $data))? $data['term'] : '';

        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                    ->where('student_code', 'LIKE', "%{$word}%")
                    ->orWhere('student_name', 'LIKE', "%{$word}%"); 
                });
            }
            
        return view('student-list', [
            'term' => $term,
            'title' => "{$this->title} : List",
            'student' => $query->paginate(5),
        ]);
        }

        function show($studentCode=0,$coursesCode=0) {
            $student = Student::where('student_code', $studentCode)->firstOrFail();
            $courses = Courses::where('courses_code', $coursesCode)->firstOrFail();
            return view('student-view', [
                'title' => "{$this->title} : View",
                'student' => $student,
                'courses' => $courses,
            ]);
            }

            function createForm(Request $request) {
                $this->authorize('update',student::class);
                $courses = courses::orderBy('courses_code');
                return view('product-create', [
                  'title' => "{$this->title} : Create",
                  'courses' => $categories->get(),
                ]);
            }
        
            function create(Request $request) {
                $this->authorize('update',student::class);
        
                try 
                {
                    $data = $request->getParsedBody();
                    $student = new student();
                    $student->fill($data);
                    $student->courses()->associate($data['courses']);
                    $student->save();
        
                    return redirect()->route('student-list')
                    ->with('status', "student {$student->student_code} was created.");
                 } 
        
                 catch(\Exception $excp) 
                 {
                    return back()->withInput()->withErrors([
                    'input' => $excp->getMessage(),
                    ]);
                }
              
            }
}

