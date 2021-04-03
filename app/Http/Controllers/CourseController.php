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
        $query = Course::orderBy('courses_code');//->withCount('shops');
        $term = (key_exists('term', $data))? $data['term'] : '';

        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                    ->where('courses_code', 'LIKE', "%{$word}%")
                    ->orWhere('courses_name', 'LIKE', "%{$word}%")
                    -> orWhere('credit', 'LIKE', "%{$word}%");
                });
            }
        
    
        return view('course-list', [
            'term' => $term,
            'title' => "{$this->title} : List",
            'course' => $query->paginate(10),
        ]);
        
    }


    function show($coursesCode=0,$studentCode=0) {
        $course = Course::where('courses_code', $coursesCode)->firstOrFail();

        return view('course-view', [
            'title' => "{$this->title} : View",
            'course' => $course,

        ]);
        }
        function createForm()
        {
          $this->authorize('update',Student::class);
          $course = Course::orderBy('courses_code');
          return view('course-create', [
            'title' => "{$this->title} : Create",
            'course' => $course->get(),
          ]);
        }
    
        function create(Request $request)
        {
            try{
              $this->authorize('update',Student::class);
              $data = $request->getParsedBody();
              $course = new Course();
              $course->fill($data);
              $course->save();
        
              return redirect()->route('course-list')
                ->with('status', "Course {$course->courses_code} was created.");
            
              }catch(\Exception $excp){
              return back()->withInput()->withErrors([
                'input' => $excp->getMessage(),
              ]);
            }
        }
}