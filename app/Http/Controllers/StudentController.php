<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Section;
use App\Classes;
use App\Subject;
use App\Announcement;

class StudentController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


  public function dashboard()
  {
    return view('pages.studentDashboard');
  }





  // Attendance

  public function attendance()
  {
    $student_id = Auth::id();
    $student_sec = Auth::user()->secId;

    $student_class_id = Section::find($student_sec)->classId;

    $student_class = Classes::find($student_class_id)->class;




    // dd($student_sec);

    $subjects =  \DB::table('subjects')
                ->join('assignsubject', 'subjects.id', '=', 'assignsubject.subjectId')
                // ->join('attendance', 'assignsubject.subjectId', '=', 'attendance.subjectId')
                ->where('assignsubject.classId', $student_class)
                // ->where('attendance.studentId', $student_id)
                // ->groupBy('assignsubject.subjectId')
                ->get();


    foreach($subjects as $subject){
        $subject->totalClasses = 0;
        $subject->present = 0;
        $subject->absent = 0;
        $subject->score = 0;

        $attendances = \DB::table('attendance')
                    ->where('subjectId', $subject->subjectId)
                    ->where('studentId', $student_id)
                    ->get();
        foreach($attendances as $attendance){
            if($attendance->status == 1){
              $subject->present++;
            }
            else {
              $subject->absent++;
            }

        }

        $subject->totalClasses = $subject->absent + $subject->present;
        $subject->score = ($subject->present == 0 ? '0' : round(($subject->present*100)/$subject->totalClasses));
    }

    return view('pages.attendance')->with('subjects', $subjects);


  }




  public function academic()
  {

    $student_id = Auth::id();
    $student_sec = Auth::user()->secId;

    $student_class_id = Section::find($student_sec)->classId;

    $student_class = Classes::find($student_class_id)->class;




    // dd($student_sec);

    $subjects =  \DB::table('subjects')
                ->join('assignsubject', 'subjects.id', '=', 'assignsubject.subjectId')
                ->join('assignteacher', 'assignteacher.subjectId', '=', 'assignsubject.subjectId')
                ->join('faculties', 'faculties.id', '=', 'assignteacher.facultyId')
                ->select('faculties.name AS facultyName', 'subjects.name')

                ->where('assignsubject.classId', $student_class)
                ->where('assignteacher.sectionId', $student_sec)
                ->get();


    return view('pages.academic')->with('subjects', $subjects);


  }
  public function academic_details($subject)
  {

      $studentId = Auth::id();
      $subjectId = Subject::where('name', $subject)->first()->id;


      $evaluations =  \DB::table('evaluations')
                  ->join('evaluationmarks', 'evaluationmarks.evaluationId', '=', 'evaluations.id')
                  ->where('evaluationmarks.studentId', $studentId)
                  ->where('evaluations.subjectId', $subjectId)
                  ->get();





    return view('pages.academic_view')->with([
        'subject' => $subject,
        'evaluations' => $evaluations
      ]);
  }



  public function announcement()
  {


      $student_id = Auth::id();
      $student_sec = Auth::user()->secId;

      $student_class_id = Section::find($student_sec)->classId;

      $student_class = Classes::find($student_class_id)->class;



      $announcements = \DB::table('announcement')->where('classId', 0)->orWhere('classId', $student_class)->where('sectionId', 0)->orWhere('sectionId', $student_sec)->orderBy('id', 'desc')->simplePaginate(5);

      foreach($announcements as $announcement){

            // Cleaning Attachments
            $attachments = explode(",", $announcement->attachment);
            array_pop($attachments);

            $announcement->attachment = $attachments;



            $announcement->facultyName = "";
            $faculties = \DB::table('faculties')
                      ->where('id', $announcement->facultyId)

                      ->get();
                      foreach($faculties as $faculty){
                          $announcement->facultyName = $faculty->name;
                      }
    }

      return view('pages.announcement')->with('announcements', $announcements);
  }





  public function feedback()
  {

    $student_id = Auth::id();
    $student_sec = Auth::user()->secId;

    $student_class_id = Section::find($student_sec)->classId;

    $student_class = Classes::find($student_class_id)->class;




    // dd($student_sec);

    $subjects =  \DB::table('subjects')
                ->join('assignsubject', 'subjects.id', '=', 'assignsubject.subjectId')
                ->where('assignsubject.classId', $student_class)
                ->get();

    return view('pages.give_feedback')->with('subjects', $subjects);


  }

  public function submit_feedback(Request $request){

    $this->validate($request, ['subjectId' => 'required|int', 'title' => 'required|string', 'message' => 'required|string']);


    $student_id = Auth::id();

    $faculty = \DB::table('assignteacher')
                  ->select('facultyId')
                  ->where('subjectId', $request->subjectId)->get()->first();

    $facultyId = $faculty->facultyId;


      \DB::table('parentsfeedback')
          ->insert([
              'facultyId' => $facultyId,
              'studentId' => $student_id,
              'subjectId' => $request->subjectId,
              'feedback' => $request->message,
              'title' => $request->title
          ]);


      \Session::flash('flash_message', 'You have succesfully submitted feedback !');

    return redirect('give_feedback');

  }








}
