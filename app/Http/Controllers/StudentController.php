<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Student;

class StudentController extends Controller
{
    private $title = 'Student';

    public function __construct() {
        $this->middleware('auth');
    }

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Student::orderBy('student_code');//->withCount('shops');
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
            'student' => $query->paginate(10),
        ]);
        }

        function show($studentCode=0,$coursesCode=0) {
            $student = Student::where('student_code', $studentCode)->firstOrFail();
            //$courses = Courses::where('courses_code', $coursesCode)->firstOrFail();
            return view('student-view', [
                'title' => "{$this->title} : View",
                'student' => $student,
                //'courses' => $courses
            ]);
            }

        function createForm(Request $request) {
            $this->authorize('update',Student::class);
           
            return view('student-create', [
            'title' => "{$this->title} : Create",
  
            ]);
        }

        function create(Request $request) {
            $this->authorize('update',Student::class);

            try 
            {
                $data = $request->getParsedBody();
                $student = new Student();
                $student->fill($data);
                $student->save();

                return redirect()->route('student-list')
                ->with('status', "Student {$student->student_code} was created.");
            } 

            catch(\Exception $excp) 
            {
                return back()->withInput()->withErrors([
                'input' => $excp->getMessage(),
                ]);
            }
        
        }

        function updateForm($studentCode) {
            //$this->authorize('update',Student::class);
            $student = Student::where('student_code', $studentCode)->firstOrFail();
           
            return view('student-update', [
              'title' => "{$this->title} : Update",
              'student' => $student,
             // 'year' => $student->student_year,
            ]);
        }
    
        function update(Request $request, $studentCode) {
           // $this->authorize('update',Student::class);
            try 
            {
                $student = Student::where('student_code', $studentCode)->FirstOrFail();
                
                $data = $request->getParsedBody();
                $student->fill($data);
                $student->save();
            
                return redirect()->route('student-view', [
                    'student' => $student->student_code,
                ])->with('status', "Student {$student->code} was updated.");
             } 
    
             catch(\Exception $excp) 
             {
                return back()->withInput()->withErrors([
                'input' => $excp->getMessage(),
                ]);
            }
    
          }
    
        function delete($studentCode) {
           // $this->authorize('update',Student::class);
            $student = Student::where('student_code', $studentCode)->firstOrFail();
            $student->delete();
    
            return redirect()->route('student-list')
          ->with('status', "Student {$student->student_code} was deleted.");
        }  
}
