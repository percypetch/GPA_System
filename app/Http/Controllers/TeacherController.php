<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Teacher;
use App\Models\Course;

class TeacherController extends Controller
{
    private $title = 'Teacher';

    public function __construct() {
        $this->middleware('auth');
    }

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Teacher::orderBy('teacher_code');//->withCount('shops');
        $term = (key_exists('term', $data))? $data['term'] : '';

        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                    ->where('teacher_code', 'LIKE', "%{$word}%")
                    ->orWhere('teacher_name', 'LIKE', "%{$word}%"); 
                });
            }
            
        return view('teacher-list', [
            'term' => $term,
            'title' => "{$this->title} : List",
            'teacher' => $query->paginate(10),
        ]);
        }

        function show(Request $request,$teacherCode=0,$coursesCode=0) {
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
            $data = $request->getQueryParams();
            $query = $teacher->courses()->orderBy('course_code');
            
            return view('teacher-view', [
                'title' => "{$this->title} : View",
                'teacher' => $teacher,
                'courses' => $query->paginate(5),
            ]);
            }

        function createForm(Request $request) {
            $this->authorize('update',Teacher::class);
           
            return view('teacher-create', [
            'title' => "{$this->title} : Create",
  
            ]);
        }

        function create(Request $request) {
            $this->authorize('update',Teacher::class);

            try 
            {
                $data = $request->getParsedBody();
                $teacher = new Teacher();
                $teacher->fill($data);
                $teacher->save();

                return redirect()->route('teacher-list')
                ->with('status', "Teacher {$teacher->teacher_code} was created.");
            } 

            catch(\Exception $excp) 
            {
                return back()->withInput()->withErrors([
                'input' => $excp->getMessage(),
                ]);
            }
        
        }

        function updateForm($teacherCode) {
            $this->authorize('update',Teacher::class);
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
           
            return view('teacher-update', [
              'title' => "{$this->title} : Update",
              'teacher' => $teacher,
             // 'year' => $teacher->teacher_year,
            ]);
        }
    
        function update(Request $request, $teacherCode) {
            $this->authorize('update',Teacher::class);
            try 
            {
                $teacher = Teacher::where('teacher_code', $teacherCode)->FirstOrFail();
                
                $data = $request->getParsedBody();
                $teacher->fill($data);
                $teacher->save();
            
                return redirect()->route('teacher-view', [
                    'teacher' => $teacher->teacher_code,
                ])->with('status', "Teacher {$teacher->code} was updated.");
             } 
    
             catch(\Exception $excp) 
             {
                return back()->withInput()->withErrors([
                'input' => $excp->getMessage(),
                ]);
            }
    
          }
    
        function delete($teacherCode) {
            $this->authorize('update',Teacher::class);
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
            $teacher->delete();
    
            return redirect()->route('teacher-list')
          ->with('status', "Teacher {$teacher->teacher_code} was deleted.");
        }



        function addCourseForm(Request $request, $teacherCode) {
            $this->authorize('update',Teacher::class);
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
            $data = $request->getQueryParams();
            $query = Course::orderBy('course_code')->whereDoesntHave('teachers', function($innerQuery) use ($teacher) {
                $innerQuery->where('id', $teacher->id);
            });
            $term = (key_exists('term', $data))? $data['term'] : '';
    
            foreach(preg_split('/\s+/', $term) as $word) {
                $query->where(function($innerQuery) use ($word) {
                    return $innerQuery
                        ->where('course_code', 'LIKE', "%{$word}%")
                        ->orWhere('course_name', 'LIKE', "%{$word}%");
                        });
            }
    
            return view('teacher-add-course', [
            'title' => "{$this->title} {$teacher->teacher_code} : Add Course",
            'term' => $term,
            'teacher' => $teacher,
            'courses' => $query->paginate(5),
            ]);
        }

        function addCourse(Request $request, $teacherCode) {
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
            $data = $request->getParsedBody();
            $teacher->courses()->attach($data['course']);
            
            return back()
            ->with('status', "Course {$data['courseCode']} was added to Teacher {$teacher->teacher_code}.");
            ;
            }

        function removeCourse($teacherCode, $courseCode) {
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
            $course = $teacher->courses()
            ->where('course_code', $courseCode)->firstOrFail();
            $teacher->courses()->detach($course);
            
            return back()
            ->with('status', "Course {$course->course_code} was removed from Teacher {$teacher->teacher_code}.");
            ;
            }
}
