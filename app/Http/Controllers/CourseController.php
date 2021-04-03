<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    private $title = 'Course';

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Course::orderBy('course_code');//->withCount('shops');
        $term = (key_exists('term', $data))? $data['term'] : '';

        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                    ->where('course_code', 'LIKE', "%{$word}%")
                    ->orWhere('course_name', 'LIKE', "%{$word}%")
                    -> orWhere('credit', 'LIKE', "%{$word}%");
                });
            }
        
    
        return view('course-list', [
            'term' => $term,
            'title' => "{$this->title} : List",
            'course' => $query->paginate(10),
        ]);
        
    }


    function show(Request $request,$courseCode=0,$studentCode=0) {
        $course = Course::where('course_code', $courseCode)->firstOrFail();
        $data = $request->getQueryParams();
        $query_student = $course->students()->orderBy('student_code');
        $query_teacher = $course->teachers()->orderBy('teacher_code');
        return view('course-view', [
            'title' => "{$this->title} : View",
            'course' => $course,
            'students' => $query_student->get(),
            'teachers' => $query_teacher->get(),

        ]);
        }
    function createForm() {
        $this->authorize('update',Student::class);
        $course = Course::orderBy('course_code');
        return view('course-create', [
            'title' => "{$this->title} : Create",
            'course' => $course->get(),
        ]);
    }
    
    function create(Request $request) {
        try{
            $this->authorize('update',Student::class);
            $data = $request->getParsedBody();
            $course = new Course();
            $course->fill($data);
            $course->save();
        
            return redirect()->route('course-list')
            ->with('status', "Course {$course->course_code} was created.");
            
            }catch(\Exception $excp){
                return back()->withInput()->withErrors([
                'input' => $excp->getMessage(),
              ]);
            }
    }
        
    function updateForm($courseCode) {
        $this->authorize('update',Student::class);
        $course = Course::where('course_code', $courseCode)->firstOrFail();
           
        return view('course-update', [
            'title' => "{$this->title} : Update",
            'course' => $course,
      
        ]);
    }
    
    function update(Request $request, $courseCode) {
        $this->authorize('update',Student::class);
        try{
            $course = Course::where('course_code', $courseCode)->FirstOrFail(); 
            $data = $request->getParsedBody();
            $course->fill($data);
            $course->save();
            return redirect()->route('course-view', [
                'course' => $course->course_code,])
                ->with('status', "Course {$course->code} was updated.");
            } 
                catch(\Exception $excp) 
        {
            return back()->withInput()->withErrors([
            'input' => $excp->getMessage(),
                ]);
        }
    }

    function delete($courseCode) {
        $this->authorize('update',Student::class);
        $course = Course::where('course_code', $courseCode)->firstOrFail();
        $course->delete();
        return redirect()->route('course-list')->with('status', "Course {$course->course_code} was deleted.");
    } 

}