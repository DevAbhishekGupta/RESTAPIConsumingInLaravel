<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use App\Course;
use Input;

class CourseController extends Controller
{
    public function retrieveData()
    {
    	try{

    		$client = new GuzzleHttpClient();
    		$apiReq = $client->request('GET', 'https://api.coursera.org/api/courses.v1', ['query'=> ['plain'=>'Ab1L853Z24N'],
    	]);

    		$content = json_decode($apiReq->getBody()->getContents());

    		$courses = $content->elements;

    		return view('courses.homepage', ['courses' => $courses]);
    		

    	}
    	catch(RequestException $re)
    	{

    	}
    }

    public function savedCourses()
    {
    	$courses = Course::orderBy('created_at','desc')->get();
    	return view('courses.saved_course', ['courses' => $courses]); 
    }

    public function saveCourse()
    {
    	
		$courseid = Input::get('courseid');
		$courseName = Input::get('coursename');
		$courseType = Input::get('coursetype');

    	$course = new Course;		
		$course->fill(['course_id' => $courseid, 'course_name' => $courseName, 'course_type' => $courseType]);
		$course->save();

		$courses = Course::orderBy('created_at','desc')->get();
    	return view('courses.saved_course', ['courses' => $courses]); 
    }
}
