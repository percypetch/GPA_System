<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Charts\CourseChart;

class CourseController extends Controller
{
    private $title = 'Course';

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Course::orderBy('course_code')->withCount('students');
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

    function showChart(Request $request){
        $tbl = Course::withCount('students')->withCount('teachers')->get();
        $cs = Course::withCount('students')->pluck('students_count', 'course_name');
        $tcs = Course::withCount('teachers')->pluck('teachers_count', 'course_name');
        $chart = new CourseChart;
        $chart->labels($cs->keys());
        $chart->dataset('Student number', 'bar', $cs->values())->backgroundColor('#edc242');
        $chart->dataset('Teacher number', 'bar', $tcs->values())->backgroundColor('#638dff');;
        return view('course-chart', [
            'chart' => $chart,
            'tbl' => $tbl
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
        $this->authorize('update',Course::class);
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
        $this->authorize('update',Course::class);
        $course = Course::where('course_code', $courseCode)->firstOrFail();
           
        return view('course-update', [
            'title' => "{$this->title} : Update",
            'course' => $course,
      
        ]);
    }
    
    function update(Request $request, $courseCode) {
        $this->authorize('update',Course::class);
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
        $this->authorize('update',Course::class);
       
        try{
            $course = Course::where('course_code', $courseCode)->firstOrFail();
            $course->delete();
            
        
            return redirect()->route('course-list')
            ->with('status', "Course {$course->course_code} was deleted.");
            
            }catch(\Exception $excp){
                return back()->withInput()->with('error', "Course {$course->course_code} can not delete, because there are students or teachers in this course.");([
                'input' => $excp->getMessage(),
              ]);
            }
    } 

}