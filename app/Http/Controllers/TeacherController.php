<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\AssignTeacher;
use App\Student;
use App\Evaluation;
use App\Subject;
use App\Section;
use App\Classes;
use App\Attendance;
use Session;
use App\Http\Requests\SubmitEvaluationRequest;
use Storage;


class TeacherController extends Controller
{

  public function __construct()
  {
     $this->middleware('auth:faculty');



  }




  public function vue(){
    return view('pages.vue');
  }


  public function login(){
    return view('pages.add_attendance');
  }


  public function get_students(Request $request){
      $teacher_id = Auth::id();

      $students = Student::where('secId', $request->sectionId)->get();

      return $students;


  }

  public function get_attendances(Request $request){
      $teacher_id = Auth::id();


      $attendance = \DB::table('attendance')

                          ->where('sectionId', $request->sectionId)
                          ->where('subjectId', $request->subjectId)
                          ->groupBy('topic')
                          ->get();

      return $attendance;


  }


  public function get_evaluations(Request $request){
      $teacher_id = Auth::id();


      $attendance = \DB::table('evaluations')

                          ->where('sectionId', $request->sectionId)
                          ->where('subjectId', $request->subjectId)
                          ->get();

      return $attendance;


  }




  public function edit_attendance_view($id){

    $attendance = \DB::table('attendance')
                      ->where('id', $id)
                      ->first();


    $sectionId = $attendance->sectionId;
    $subjectId = $attendance->subjectId;
    $date = $attendance->date;
    $topic = $attendance->topic;


    $subject = Subject::find($subjectId)->name;
    $section = Section::find($sectionId)->sec;
    $class_id = Section::find($sectionId)->classId;

    $class = Classes::find($class_id)->class;



    $attendances = \DB::table('attendance')
                    ->where('sectionId', $sectionId)
                    ->where('date', $date)
                    ->where('topic', $topic)
                    ->get();



    return view('pages.edit_attendance_view')->with([
      'subject' => $subject,
      'class' => $class,
      'section' => $section,
      'attendances' => $attendances
    ]);




  }

  public function update_attendance(Request $request){
    $this->validate($request, ['topic' => 'required|string|min:3']);

    $x = 0;
    foreach($request->studentId as $student){

      $request->date = Carbon::parse($request->date);


        \DB::table('attendance')
        ->where('studentId', $student)
        ->where('subjectId', $request->subjectId)
        ->where('date', $request->date)
        ->update([ 'topic' => $request->topic , 'status' => (!empty($request->status[$x]) ? '1' : '0') ]);

      $x++;
    }


    \Session::flash('flash_message', 'You have updated the attendance succesfully !');

    return redirect('edit_attendance');
  }






  /**
    * Method: update_evaluation
    * Description: To update evaluation.
  */


  public function update_evaluation(Request $request){
    $this->validate($request, ['title' => 'required|string|min:3', 'totalMarks' => 'required|int', 'weightage' => 'required|int']);



    // Evaliaton Itself

      $section = Section::find($request->sectionId);
      $class_id = $section->classId;
      $class = Classes::find($class_id);

      // Checking if any student marks are greater than the total marks.
      $marksCheck = 0;
      $x = 0;
      foreach($request->studentId as $student){
          if($request->obtainedMarks[$x] > $request->totalMarks){

              $studentI = Student::find($student);
              Session::flash('danger', 'Student '.$studentI->name .' Obtained Marks, can not be greater than Total Marks');
              $marksCheck = 1;
          }
          $x++;


      }

      if($marksCheck != 1){

        // Verify Evaluation Name, For Same Subject
        $evaluation = Evaluation::where('name', $request->title)
                                  ->where('subjectId', $request->subjectId)
                                  ->where('sectionId', $request->sectionId)
                                  ->where('id', '!=', $request->evaluationId)
                                  ->get();

        if($evaluation->count() == 0){
            \DB::table('evaluations')
            ->where('id', $request->evaluationId)
            ->update(['weightage' => $request->weightage,'totalMarks' => $request->totalMarks,'name' => $request->title]);


            // Evaluation Marks
            $x = 0;
            foreach($request->studentId as $student){
                \DB::table('evaluationmarks')
                ->where('studentId', $student)
                ->where('evaluationId', $request->evaluationId)
                ->update(['obtained' => (empty($request->obtainedMarks[$x]) ? 0 : $request->obtainedMarks[$x] ) ]);
                $x++;
            }


            \Session::flash('flash_message', 'You have updated the evaluation succesfully !');

            return redirect('edit_evaluation');
        }
        else {
            Session::flash('danger', 'Evaluation '.$request->title. ' already exists for Class '.$class->class. ' Section '.$section->sec);
            return redirect('edit_evaluation/'.$request->evaluationId);

        }

      }
      else {
        return redirect('edit_evaluation/'.$request->evaluationId);
      }

  }





  public function edit_evaluation_view($id){

    $evaluation = \DB::table('evaluations')
                      ->where('id', $id)
                      ->first();


    $sectionId = $evaluation->sectionId;
    $subjectId = $evaluation->subjectId;
    $topic = $evaluation->name;


    $subject = Subject::find($subjectId)->name;
    $section = Section::find($sectionId)->sec;
    $class_id = Section::find($sectionId)->classId;

    $class = Classes::find($class_id)->class;



    $evaluations = \DB::table('evaluations')
                    ->join('evaluationmarks','evaluationmarks.evaluationId', '=', 'evaluations.id')
                    ->where('sectionId', $sectionId)
                    ->where('name', $topic)
                    ->where('subjectId', $subjectId)
                    ->get();


    return view('pages.edit_evaluation_view')->with([
      'subject' => $subject,
      'class' => $class,
      'section' => $section,
      'evaluation_id' => $id,
      'evaluations' => $evaluations

    ]);




  }




  public function submit_evaluation(SubmitEvaluationRequest $request){


        $teacher_id = Auth::id();
        $section = Section::find($request->sectionId);
        $class_id = $section->classId;
        $class = Classes::find($class_id);


        // Checking if any student marks are greater than the total marks.
        $marksCheck = 0;
        $x = 0;
        foreach($request->studentId as $student){
            if($request->obtainedMarks[$x] > $request->totalMarks){

                $studentI = Student::find($student);
                Session::flash('danger', 'Student '.$studentI->name .' Obtained Marks, can not be greater than Total Marks');
                $marksCheck = 1;
            }
            $x++;

        }

       if($marksCheck != 1) {
          // Verify Evaluation Name, For Same Subject
          $evaluation = Evaluation::where('name', $request->title)
                                    ->where('subjectId', $request->subjectId)
                                    ->where('sectionId', $request->sectionId)
                                    ->get();

          if($evaluation->count() == 0){
            // Adding Evaluation Details

                  \DB::table('evaluations')
                      ->insert([
                          'sectionId' => $request->sectionId,
                          'subjectId' => $request->subjectId,
                          'facultyId' => $teacher_id,
                          'weightage' => $request->weightage,
                          'totalMarks' => $request->totalMarks,
                          'name' => $request->title,
                        ]);



                  $evaluation = Evaluation::orderBy('id', 'desc')->first();
                  $evaluation_id = $evaluation->id;

                  $x = 0;
                  foreach($request->studentId as $student){

                    $request->date = Carbon::parse($request->date);

                    \DB::table('evaluationmarks')
                        ->insert([
                            'evaluationId' => $evaluation_id,
                            'studentId' => $student,
                            'obtained' => (empty($request->obtainedMarks[$x]) ? 0 : $request->obtainedMarks[$x] ),
                          ]);

                    $x++;

                    $notification = "Your marks have been added for ".$request->title. " in ".Subject::find($request->subjectId)->name;
                    $link = "/academic";

                    \DB::table('student_notifications')
                        ->insert([
                            'studentId' => $student,
                            'notification' => $notification,
                            'link' => $link,
                          ]);

                  }


                  \Session::flash('flash_message', 'You have added the evaluation marks succesfully !');
          }
          else {
              Session::flash('danger', 'Evaluation '.$request->title. ' already exists for Class '.$class->class. ' Section '.$section->sec);
          }
        }



        return redirect('add_evaluation');

  }




  public function submit_attendance(Request $request){

    $this->validate($request, ['date' => 'required|date', 'sectionId' => 'required|int', 'subjectId' => 'required|int', 'topic' => 'required|string|min:3']);


    $section = Section::find($request->sectionId);
    $class_id = $section->classId;
    $class = Classes::find($class_id);

    $request->date = Carbon::parse($request->date);
    $attendance = Attendance::where('date', $request->date)
                              ->where('subjectId', $request->subjectId)
                              ->where('sectionId', $request->sectionId)
                              ->get();

    if($attendance->count() == 0){
      $x = 0;
      foreach($request->studentId as $student){
        \DB::table('attendance')
              ->insert(
                  ['date' => $request->date, 'studentId' => $student, 'sectionId' => $request->sectionId , 'subjectId' => $request->subjectId, 'topic' => $request->topic , 'status' => (!empty($request->status[$x]) ? '1' : '0') ]
                );
          $x++;
        }
        \Session::flash('flash_message', 'You have added the attendance succesfully !');

    }
    else {
      Session::flash('danger', 'You have already added attendance for '.$request->date. ' for Class '.$class->class. ' Section '.$section->sec);
    }




    // $notification = "You have been marked present in, ".Subject::find($request->subjectId)->name;
    // $link = "/attendance";
    //
    // \DB::table('student_notifications')
    //     ->insert([
    //         'studentId' => $student,
    //         'notification' => $notification,
    //         'link' => $link,
    //       ]);





    return redirect('add_attendance');


  }

  public function add_attendance(){
    //

    $teacher_id = Auth::id();




    $classes =  \DB::table('faculties')
                ->join('assignteacher', 'faculties.id', '=', 'assignteacher.facultyId')
                ->join('section', 'assignteacher.sectionId', '=', 'section.id')
                ->join('classes', 'classes.id', '=', 'section.classId')
                ->join('subjects', 'subjects.id', '=', 'assignteacher.subjectId')

                ->where('facultyId', $teacher_id)
                ->get();





    return view('pages.add_attendance')->with([
        'classes' => $classes
    ]);
  }

  public function edit_attendance(){

    $teacher_id = Auth::id();




    $classes =  \DB::table('faculties')
                ->join('assignteacher', 'faculties.id', '=', 'assignteacher.facultyId')
                ->join('section', 'assignteacher.sectionId', '=', 'section.id')
                ->join('classes', 'classes.id', '=', 'section.classId')
                ->join('subjects', 'subjects.id', '=', 'assignteacher.subjectId')

                ->where('facultyId', $teacher_id)
                ->get();





    return view('pages.edit_attendance')->with([
        'classes' => $classes
    ]);

  }

  public function add_evaluation(){

    $teacher_id = Auth::id();




    $classes =  \DB::table('faculties')
                ->join('assignteacher', 'faculties.id', '=', 'assignteacher.facultyId')
                ->join('section', 'assignteacher.sectionId', '=', 'section.id')
                ->join('classes', 'classes.id', '=', 'section.classId')
                ->join('subjects', 'subjects.id', '=', 'assignteacher.subjectId')

                ->where('facultyId', $teacher_id)
                ->get();





    return view('pages.add_evaluation')->with([
        'classes' => $classes
    ]);


  }

  public function edit_evaluation(){

    $teacher_id = Auth::id();




    $classes =  \DB::table('faculties')
                ->join('assignteacher', 'faculties.id', '=', 'assignteacher.facultyId')
                ->join('section', 'assignteacher.sectionId', '=', 'section.id')
                ->join('classes', 'classes.id', '=', 'section.classId')
                ->join('subjects', 'subjects.id', '=', 'assignteacher.subjectId')

                ->where('facultyId', $teacher_id)
                ->get();





    return view('pages.edit_evaluation')->with([
        'classes' => $classes
    ]);


  }

  public function make_announcement(){

    $teacher_id = Auth::id();



      $classes = Classes::all();


      $classes->map(function ($class) {
          $sections = Section::where('classId', $class->class)->get();
          $class['sections'] = $sections;
          return $class;
      });




    return view('pages.make_announcement')->with([
        'classes' => $classes
    ]);


  }

  public function edit_announcement(){

   $announcements = \DB::table('announcement')
                        ->orderBy('id', 'desc')
                        ->get();


    return view('pages.edit_announcement')->with('announcements', $announcements);
  }


  public function submit_announcement(Request $request){
      $this->validate($request, ['classId' => 'required|int', 'sectionId' => 'required|int', 'title' => 'required|string', 'summary' => 'required|string', 'attachments' => 'required']);


      $facultyId = Auth::id();


      $filenames = "";

      foreach ($request->attachments as $attachment) {
        //      Storage::disk('uploads')->put('attachments', $attachment);
        $attachment->storeAs('attachments', $attachment->getClientOriginalName() );


              $filenames .=  $attachment->getClientOriginalName() . ',';

      }


      \DB::table('announcement')
          ->insert([
              'classId' => (!empty($request->classId) ? $request->classId : '0'),
              'sectionId' => (!empty($request->sectionId) ?  $request->sectionId : '0'),
              'facultyId' => $facultyId,
              'title' => $request->title,
              'attachment' => $filenames,
              'summary' => $request->summary,

          ]);


      if($request->classId == 0 && $request->sectionId == 0) {
         $students = \DB::table('students')
                      ->get();
        }
      else if($request->classId != 0 && $request->sectionId == 0){
        $section = \DB::table('section')
                      ->where('classId', $request->classId)
                      ->get();

        $sections = [];
        foreach($section as $s){
          array_push($sections, $s->id);
        }


        $students = \DB::table('students')
                    ->whereIn('secId', $sections)
                    ->get();
      }
      else if($request->classId != 0 && $request->sectionId != 0){
        $students = \DB::table('students')
                    ->where('secId', $request->sectionId)
                    ->get();
      }


      $notification = "A new annoucement has been added";
      $link = "/announcement";
      foreach($students as $student){
        \DB::table('student_notifications')
            ->insert([
                'studentId' => $student->id,
                'notification' => $notification,
                'link' => $link,
              ]);
      }





      \Session::flash('flash_message', 'You have added the annoucement succesfully !');

      return redirect('make_announcement');

  }









  public function edit_announcement_view($id){

    $announcement = \DB::table('announcement')
                          ->where('id', $id)
                          ->first();

    $attachments = explode(",", $announcement->attachment);
    array_pop($attachments);

    $announcement->attachment = $attachments;





    return view('pages.edit_announcement_view')->with('announcement', $announcement);


  }

  public function update_announcement(Request $request){

      $this->validate($request, ['title' => 'required|string', 'summary' => 'required|string']);

      $newFiles = 0;
      if($request->editAttachment != 1 || empty($request->editAttachment) || !isset($request->editAttachment)){
          $filenames = "";
          foreach ($request->attachments as $attachment) {
              //      Storage::disk('uploads')->put('attachments', $attachment);
            $attachment->storeAs('attachments', $attachment->getClientOriginalName() );
            $filenames .=  $attachment->getClientOriginalName() . ',';
          }
        $newFiles = 1;
      }



      if($newFiles == 1) {
        \DB::table('announcement')
          ->where('id', $request->announcementId)
          ->update(['title' => $request->title, 'summary' => $request->summary, 'attachment' => $filenames]);
      }

      else {
        \DB::table('announcement')
          ->where('id', $request->announcementId)
          ->update(['title' => $request->title, 'summary' => $request->summary]);
      }


        \Session::flash('flash_message', 'You have updated the announcement succesfully !');


        return redirect()->route('editAnnouncement');

  }

  public function delete_announcement($id){
      \DB::table('announcement')
            ->where('id', $id)

            ->delete();

            \Session::flash('flash_message', 'You have deleted the announcement succesfully !');

            return redirect('edit_announcement');

  }

  public function feedback(){


      $teacher_id = Auth::id();

      $feedback = \DB::table('parentsfeedback')
                    ->join('students', 'students.id', '=', 'parentsfeedback.studentId')

                    ->where('facultyId', $teacher_id)
                    ->orderBy('parentsfeedback.id', 'DESC')
                    ->simplePaginate(5);


    return view('pages.feedback')->with('feedback', $feedback);
  }





/**
  * Method: update_feedbackCount
  * Description: To update the feedbackCount in table parentsfeedback
*/

public function update_feedbackCount(){
    $facultyId = \Auth::id();

    \DB::table('parentsfeedback')
        ->where('facultyId', $facultyId)
        ->update(['seen' => '1']);

    return 'Count: 0';
}














}
