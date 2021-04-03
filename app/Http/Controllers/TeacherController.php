<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Teacher;

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

        function show($teacherCode=0,$coursesCode=0) {
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
            //$courses = Courses::where('courses_code', $coursesCode)->firstOrFail();
            return view('teacher-view', [
                'title' => "{$this->title} : View",
                'teacher' => $teacher,
                //'courses' => $courses
            ]);
            }

        function createForm(Request $request) {
            //$this->authorize('update',Teacher::class);
           
            return view('teacher-create', [
            'title' => "{$this->title} : Create",
  
            ]);
        }

        function create(Request $request) {
            //$this->authorize('update',Teacher::class);

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
            //$this->authorize('update',Teacher::class);
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
           
            return view('teacher-update', [
              'title' => "{$this->title} : Update",
              'teacher' => $teacher,
             // 'year' => $teacher->teacher_year,
            ]);
        }
    
        function update(Request $request, $teacherCode) {
           // $this->authorize('update',Teacher::class);
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
           // $this->authorize('update',Teacher::class);
            $teacher = Teacher::where('teacher_code', $teacherCode)->firstOrFail();
            $teacher->delete();
    
            return redirect()->route('teacher-list')
          ->with('status', "Teacher {$teacher->teacher_code} was deleted.");
        }
}
