<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Charts\StudentChart;

class StudentController extends Controller
{
    private $title = 'Student';

    public function __construct() {
        $this->middleware('auth');
    }

        function list(Request $request) {
            $this->authorize('update',Student::class);
            $data = $request->getQueryParams();
            $query = Student::orderBy('student_code');
            $term = (key_exists('term', $data))? $data['term'] : '';
            
            foreach(preg_split('/\s+/', $term) as $word) {
                $query->where(function($innerQuery) use ($word) {
                    return $innerQuery
                        ->where('student_code', 'LIKE', "%{$word}%")
                        ->orWhere('student_name', 'LIKE', "%{$word}%")
                        ->orWhere('student_year', 'LIKE', "%{$word}%");; 
                    });
                }
                
            return view('student-list', [
                'term' => $term,
                'title' => "{$this->title} : List",
                'student' => $query->paginate(10),
                'student' => $query->paginate(100),
            ]);
        }

        function showChart(Request $request){
            $this->authorize('update',Student::class);
            $tbl = Student::withCount('courses')->get();
            $st = Student::withCount('courses')->pluck('courses_count', 'student_name');
            $chart = new StudentChart;
            $chart->labels($st->keys());
            $chart->dataset('Course registed', 'bar', $st->values())->backgroundColor('#ff94d1');
            return view('student-chart', [
                'chart' => $chart,
                'tbl' => $tbl
            ]);
        }

        function show(Request $request,$studentCode=0,$coursesCode=0) {
            $this->authorize('update',Student::class);
            $student = Student::where('student_code', $studentCode)->firstOrFail();
            $data = $request->getQueryParams();
            $query = $student->courses()->orderBy('course_code');

            return view('student-view', [
                'title' => "{$this->title} : View",
                'student' => $student,
                'courses' => $query->paginate(10),
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
                return back()->withInput()->with('error', "Duplicated 'Code' number. Please use another number.");([
                'input' => $excp->getMessage(),
                ]);
            }
        }

        function updateForm($studentCode) {
            $this->authorize('update',Student::class);
            $student = Student::where('student_code', $studentCode)->firstOrFail();
           
            return view('student-update', [
              'title' => "{$this->title} : Update",
              'student' => $student,
            ]);
        }
    
        function update(Request $request, $studentCode) {
            $this->authorize('update',Student::class);
            try 
            {
                $student = Student::where('student_code', $studentCode)->FirstOrFail();
                
                $data = $request->getParsedBody();
                $student->fill($data);
                $student->save();
            
                return redirect()->route('student-view', [
                    'student' => $student->student_code,
                ])->with('status', "Student {$student->student_code} was updated.");
             } 
    
             catch(\Exception $excp) 
             {
                return back()->withInput()->with('error', "Duplicated 'Code' number. Please use another number.");([
                'input' => $excp->getMessage(),
                ]);
            }
    
          }
    
        function delete($studentCode) {
            $this->authorize('update',Student::class);
            try{
            $student = Student::where('student_code', $studentCode)->firstOrFail();
            $student->delete();
    
            return redirect()->route('student-list')
          ->with('status', "Student {$student->student_code} was deleted.");
        }catch(\Exception $excp){
            return back()->withInput()->with('error', "Student {$student->student_code} can not delete, because the student are in courses.");([
            'input' => $excp->getMessage(),
          ]);
        }
        }  

        function addCourseForm(Request $request, $studentCode) {
            $this->authorize('update',Student::class);
            $student = Student::where('student_code', $studentCode)->firstOrFail();
            $data = $request->getQueryParams();
            $query = Course::orderBy('course_code')->whereDoesntHave('students', function($innerQuery) use ($student) {
                $innerQuery->where('id', $student->id);
             });
             
            $term = (key_exists('term', $data))? $data['term'] : '';
            foreach(preg_split('/\s+/', $term) as $word) {
                $query->where(function($innerQuery) use ($word) {
                    return $innerQuery
                        ->where('course_code', 'LIKE', "%{$word}%")
                        ->orWhere('course_name', 'LIKE', "%{$word}%")
                    ;
                });
            }

            return view('student-add-course', [
                'title' => "{$this->title} {$student->student_code} : Add Course",
                'term' => $term,
                'student' => $student,
                'courses' => $query->paginate(5),
            ]);
        }

        function addCourse(Request $request, $studentCode) {
            $this->authorize('update',Student::class);
            $student = Student::where('student_code', $studentCode)->firstOrFail();
            $data = $request->getParsedBody();
            $student->courses()->attach($data['course']);
            
            return back()
            ->with('status', "Course was added to Student {$student->student_code}.");
            ;
        }

        function removeCourse($studentCode, $courseCode) {
            $this->authorize('update',Student::class);
            $student = Student::where('student_code', $studentCode)->firstOrFail();
            $course = $student->courses()
            ->where('course_code', $courseCode)->firstOrFail();
            $student->courses()->detach($course);
            
            return back()
            ->with('status', "Course {$course->course_code} was removed from Student {$student->student_code}.");
            ;
        }
}
