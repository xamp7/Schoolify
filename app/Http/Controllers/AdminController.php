<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Classes;
use App\Faculty;
use App\Student;

use App\Section;
use App\Http\Requests\AssignSubjectRequest;
use App\AssignSubject;
use App\AssignTeacher;
use App\teacherNotification;

use Hash;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\EditStudentRequest;
use App\Http\Requests\AssignTeacherRequest;

use DB;

use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:faculty');
    }


    /**
      * Method: add_class
      * Description: Function to display, Add Class View
    */

    public function add_class()
    {
        return view('pages.add_class');
    }




    /**
      * Method: submit_class
      * Description: To add a new class to dababase
    */

    public function submit_class(Request $request)
    {
        $this->validate($request, ['class' => 'required|int', 'totalStrength' => 'required|int']);

        $classes = Classes::where('class', $request->class)->get();
        if ($classes->count() == 0) {
            Classes::create($request->all());
            Session::flash('success', 'You have succesfully added Class '. $request->class);
        } else {
            Session::flash('danger', 'Class '.$request->class.' already exists !');
        }


        return redirect('add_class');
    }





    /**
      * Method: add_teacher
      * Description: Function to display, add teachers page
    */

    public function add_teacher()
    {
        return view('pages.add_teacher');
    }



    /**
      * Method: submit_teacher
      * Description: To add new teacher to Database
    */

    public function submit_teacher(Request $request)
    {
        $this->validate($request, ['name' => 'required|string', 'phone' => 'required|string', 'password' => 'required|string', 'email' => 'required|email' ]);


        $request->merge(['password' => Hash::make($request->password) ]);

        $request->merge(['status' => (!empty($request->status) ? '1' : '0')  ]);

        $faculty = Faculty::where('email', $request->email)->get();
        if ($faculty->count()) {
            Session::flash('danger', 'Teacher with email '.$request->email.' already exists !');
        } else {
            Faculty::create($request->all());
            Session::flash('success', 'You have succesfully added Teacher '. $request->name);
        }



        return redirect('add_teacher');
    }








    /**
      * Method: add_section
      * Description: Function to display, Add Sections
    */

    public function add_section()
    {
        $classes = \DB::table('classes')
                        ->get();


        return view('pages.add_section')->with('classes', $classes);
    }




    /**
      * Method: submit_section
      * Description: Function to add a new section to Database
    */

    public function submit_section(Request $request)
    {
        $this->validate($request, ['classId' => 'required|int', 'sec' => 'required']);

        $section = Section::where(['classId' => $request->classId, 'sec' => $request->sec ])
                        ->get();



        $class = Classes::find($request->classId);

        if ($section->count()==0) {
            Section::create($request->all());
            Session::flash('success', 'You have succesfully added Section '. $request->sec .' to Class '.$class->class);
        } else {
            Session::flash('danger', 'Class '.$class->class.' Section '.$request->sec.' already exists !');
        }

        return redirect('add_section');
    }




    /**
      * Method: add_student
      * Description: Function to display view add_student
    */

    public function add_student()
    {
        $classes = Classes::all();


        $classes->map(function ($class) {
            $sections = Section::where('classId', $class->class)->get();
            $class['sections'] = $sections;
            return $class;
        });

        //
        // dd($classes);
        return view('pages.add_student')->with('classes', $classes);
    }



    /**
      * Method: submit_student
      * Description: To add new student to Database
    */

    public function submit_student(CreateStudentRequest $request)
    {
        $student = Student::where('email', $request->email)->get();
        if($student->count() == 0) {
            // Check Class Strength
            $section = Section::find($request->secId);
            $class_id = $section->classId;
            $class = Classes::find($class_id);


            if(Student::where('secId', $request->secId)->count() + 1 <= $class->totalStrength ){
                $request->merge(['password' => Hash::make($request->password) ]);
                Student::create($request->all());

                Session::flash('success', 'You have succesfully added Student '. $request->name. '.');

            }
            else {
                Session::flash('danger', 'Class '.$class->class. ' Section '.$section->sec.' has total strength of '.$class->totalStrength. ' can not add more students.');
            }
        } else {
            // Student with this email already exists
            Session::flash('danger', 'Student with email '.$request->email .' already exists !');
        }

        return redirect('add_student');
    }




    /**
      * Method: add_subject
      * Description: Funtion to display view for add_subject
    */

    public function add_subject()
    {
        return view('pages.add_subject');
    }



    /**
      * Method: submit_subject
      * Description: To add a new subject to Database
    */

    public function submit_subject(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'dep' => 'required']);

        $subject = Subject::where('name', $request->name);
        if ($subject->count() == 0) {
            Subject::create($request->all());
            Session::flash('success', 'You have succesfully added Subject '. $request->name. '.');
        } else {
            // Already Exists
            Session::flash('danger', 'Subject with name  '.$request->name .' already exists !');
        }

        return redirect('add_subject');
    }




    /**
      * Method: manage_class
      * Description: To show manage_class view
    */

    public function manage_class()
    {
        $classes = Classes::all();

        return view('pages.manage_class')->with('classes', $classes);
    }



    /**
      * Method: manage_class_edit
      * Description: Function to edit a class
    */

    public function manage_class_edit($id)
    {
        $class = Classes::find($id);

        return view('pages.edit_class')->with('class', $class);
    }



    /**
      * Method: edit_class
      * Description: Function to edit an existing class
    */

    public function edit_class(Request $request)
    {
        $this->validate($request, ['class' => 'required|int' , 'totalStrength' => 'required|int' ]);

        Classes::where('class', $request->class)
                ->update(['totalStrength' => $request->totalStrength]);

        Session::flash('success', 'You have succesfully updated Class '. $request->class. ', Total Strength to '.$request->totalStrength.'.');

        return redirect('manage_class');
    }





    /**
      * Method: manage_class_delete
      * Description: To delete an existing class
    */

    public function manage_class_delete($id)
    {
        Classes::where('id', $id)
                        ->delete();

        Session::flash('success', 'You have deleted Class '.$id.' ');


        return redirect('manage_class');
    }




    /**
      * Method: manage_student
      * Description: To display view manage_student
    */

    public function manage_student()
    {
        $students = Student::all();

        return view('pages.manage_student')->with('students', $students);
    }


    /**
      * Method: manage_student_edit
      * Description: A function to display the view for editing student. i.e edit_student
    */

    public function manage_student_edit($id)
    {
        $student = Student::find($id);

        $class_id = Section::find($student->secId)->classId;
        $class = Classes::find($class_id)->class;


        $student->class = $class;

        $classes = Classes::all();




        $classes->map(function ($class) {
            $sections = Section::where('classId', $class->class)->get();
            $class['sections'] = $sections;
            return $class;
        });

        return view('pages.edit_student')->with(['student'=> $student, 'classes' => $classes]);
    }




    /**
      * Method: edit_student
      * Description: Function to update the information of an existing student
    */

    public function edit_student(EditStudentRequest $request)
    {
        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request->password) ]);
            Student::where('id', $request->id)
                        ->update(['name' => $request->name, 'fatherName' => $request->fatherName, 'secId' => $request->secId, 'email' => $request->email, 'password' => $request->password, 'phone' => $request->phone, 'address' => $request->address, 'joined' => $request->joined]);
        } else {
            Student::where('id', $request->id)
                        ->update(['name' => $request->name, 'fatherName' => $request->fatherName, 'secId' => $request->secId, 'email' => $request->email, 'phone' => $request->phone, 'address' => $request->address, 'joined' => $request->joined]);
        }

        Session::flash('success', 'You have succesfully updated information for Student '. $request->name);

        return redirect('manage_student');
    }






    /**
      * Method: manage_teacher
      * Description: To display view manage_teacher
    */

    public function manage_teacher()
    {
        $teachers = Faculty::all();

        return view('pages.manage_teacher')->with('teachers', $teachers);
    }



    /**
      * Method: manage_teacher_edit
      * Description: A function to display the view for editing teacher. i.e edit_teacher
    */

    public function manage_teacher_edit($id)
    {
        $teacher = Faculty::find($id);

        return view('pages.edit_teacher')->with('teacher', $teacher);
    }




    /**
      * Method: manage_subject
      * Description: Function to diplay the view manage_subject
    */

    public function manage_subject()
    {
        $subjects = Subject::all();
        return view('pages.manage_subject')->with('subjects', $subjects);
    }




    /**
      * Method: manage_subject_edit
      * Description: Function to display the view for edit_subject
    */

    public function manage_subject_edit($id)
    {
        $subject = Subject::find($id);

        return view('pages.edit_subject')->with('subject', $subject);
    }



    /**
      * Method: edit_subject
      * Description: Function to update an existing subject
    */

    public function edit_subject(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'dep' => 'required']);

        $subject = Subject::where('name', $request->name)
                            ->where('id', '!=', $request->id);
        if ($subject->count() == 0) {
            Subject::where('id', $request->id)
                ->update(['name' => $request->name, 'dep' => $request->dep]);

            Session::flash('success', 'Subject '.$request->name. ' has been updated !');
        } else {
            Session::flash('danger', 'Subject'. $request->name. ' already exists');
            return redirect('manage_subject/edit/'.$request->id);
        }

        return redirect('manage_subject');
    }




    /**
      * Method: manage_subject_delete
      * Description: Function to delete a subject
    */

    public function manage_subject_delete($id)
    {
        $subject = Subject::find($id);

        Subject::where('id', $id)
                    ->delete();
        Session::flash('success', 'Subject '.$subject->name. ' has been removed !');

        return redirect('manage_subject');
    }





    /**
      * Method: manage_student_delete
      * Description: Function to delete a student
    */

    public function manage_student_delete($id)
    {
        $student = Student::find($id);
        Student::where('id', $id)
                ->delete();
        Session::flash('success', 'Student '.$student->name. ' has been removed !');

        return redirect('manage_student');
    }










    /**
      * Method: edit_teacher
      * Description: Function to update the existing teacher details
    */

    public function edit_teacher(Request $request)
    {
        $this->validate($request, ['name' => 'required|string', 'phone' => 'required|string', 'email' => 'required|email' ]);

        $request->merge(['status' => (!empty($request->status) ? '1' : '0')  ]);


        $teacher = Faculty::where('email', $request->email)->
                            where('id', '!=', $request->id);

        if ($teacher->count() == 0) {
            if (empty($request->password)) {
                Faculty::where('id', $request->id)
                        ->update(['name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'status' => $request->status]);
            } else {
                $request->merge(['password' => Hash::make($request->password) ]);
                Faculty::where('id', $request->id)
                        ->update(['name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'status' => $request->status, 'password' => $request->password]);
            }

            Session::flash('success', 'Teacher '.$request->name. 'settings have been updated !');
        } else {
            // Teacher with email already exists

            Session::flash('danger', 'Teacher with email '.$request->email. 'already exists !');
            return redirect('manage_teacher/edit/'.$request->id);
        }

        return redirect('manage_teacher');
    }




    /**
      * Method: manage_teacher_delete
      * Description: Function to delete an existing teacher
    */

    public function manage_teacher_delete($id)
    {
        $teacher = Faculty::find($id);
        Faculty::find($id)->delete();


        Session::flash('success', 'Teacher '. $teacher->name. ' has been deleted !');

        return redirect('manage_teacher');
    }




    /**
      * Method: manage_section
      * Description: Function to display the view for manage_section
    */

    public function manage_section()
    {
        $classes = Classes::all();


        $classes->map(function ($class) {
            $sections = Section::where('classId', $class->class)->get();
            $class['sections'] = $sections;
            return $class;
        });


        return view('pages.manage_section')->with('classes', $classes);
    }




    /**
      * Method: get_sections
      * Description: Function to get the respective sections of a class
    */

    public function get_sections(Request $request)
    {
        $sections = Section::where('classId', $request->classId)->get();

        return $sections;
    }



    /**
      * Method: edit_section
      * Description: Function to edit the information of an existing section.
    */

    public function edit_section(Request $request)
    {
        $this->validate($request, ['sec' => 'required']);

        $section = Section::find($request->secId);
        $class = Classes::find($section->classId);

        // Checking if section already exists
        $checkSection = Section::where('classId', $class->id)
                            ->where('sec', $request->sec)
                            ->where('id', '!=', $request->secId)
                            ->get();


        if ($checkSection->count() == 0) {
            Section::where('id', $request->secId)
                        ->update(['sec' => $request->sec]);
            Session::flash('success', 'Section '.$request->sec. ' for Class '.$class->class.' has been updated !');
        } else {
            Session::flash('danger', 'Section '.$request->sec. ' already exists for Class '.$class->class);
        }


        return redirect('manage_section');
    }



    /**
      * Method: manage_section_delete
      * Description: Function to delete a section
    */

    public function manage_section_delete($id)
    {
        $section = Section::find($id);
        $class = Classes::find($section->classId);

        Section::where('id', $id)
                ->delete();

        Session::flash('success', 'Section '.$section->sec. ' of Class '.$class->class. ' has been removed !');

        return redirect('manage_section');
    }














    /**
      * Method: assign_subject_view
      * Description: Function to display the view for assign_teacher
    */

    public function assign_subject_view()
    {
        $subjects = Subject::all();
        $classes = Classes::all();


        $assigned = AssignSubject::select('classId')->groupBy('classId')->get();

        foreach($assigned as $assign){
            $assignSubject = AssignSubject::select('subjectId')->where('classId', $assign->classId)->get();
            $assign->subjectIds = $assignSubject;
        }


        // dd($assigned);


        // dd(Subject::all());
        return view('pages.assign_subject')->with([
            "subjects" => $subjects,
            "classes" => $classes,
            "assignedSubjects" => $assigned
        ]);
    }




    /**
      * Method: assign_subject
      * Description: To assign a subject to class
    */

    public function assign_subject(AssignSubjectRequest $request)
    {



        $class = $request->class;
        $classI = Classes::find($class);

        $subject = $request->subject;
        $subjectI = Subject::find($subject);


        if(AssignSubject::where('subjectId', $subject)->where('classId',$class)->count() == 0 ){
            AssignSubject::create(['classId'=>$class, 'subjectId'=>$subject]);
            Session::flash('flash_message', 'You have assigned the Subject '.$subjectI->name.' to Class '.$classI->class.' successfully');
        }
        else {
            Session::flash('danger', 'Subject '.$subjectI->name.' is already assigned to Class '.$classI->class.'  ');
        }

        // if(AssignSubject::find())

        return redirect('assign_subject');
    }





    /**
      * Method: assign_subject_remove
      * Description: Function to unassign a subject.
    */

    public function assign_subject_remove($id, $classId){

        $subject = Subject::find($id);
        $class = Classes::find($classId);

        AssignSubject::where('subjectId', $id)
            ->where('classId', $classId)
            ->delete();

        Session::flash('danger', 'Subject '.$subject->name. 'has been unassigned from Class '.$class->class);

        return redirect('assign_subject');
    }






    /**
      * Method: assign_teacher_view
      * Description: Function to display the view for assign_teacher
    */


    public function assign_teacher_view()
    {
        $subjects = Subject::all();
        $classes = Classes::all();
        $faculty = Faculty::all();


        $classes->map(function ($class) {
            $sections = Section::where('classId', $class->class)->get();
            $class['sections'] = $sections;
            return $class;
        });

        $assigned = AssignSubject::select('classId')->groupBy('classId')->get();

        foreach($assigned as $assign){
            $assignSubject = AssignSubject::select('subjectId')->where('classId', $assign->classId)->get();
            $assign->subjectIds = $assignSubject;
        }


        $assignedTeachers = AssignTeacher::select('facultyId')->groupBy('facultyId')->get();

        foreach($assignedTeachers as $assignTeacher){
            $aT = AssignTeacher::select('subjectId', 'sectionId')->where('facultyId', $assignTeacher->facultyId)->get();
            $assignTeacher->subjectIds = $aT;

            foreach($assignTeacher->subjectIds as $madeUp){
                $class_id = Section::find($madeUp->sectionId)->classId;
                $class = Classes::find($class_id);
                $madeUp->classIds = $class;
            }
        }




        // dd(Subject::all());
        return view('pages.assign_teacher')->with([
            "subjects" => $subjects,
            "classes" => $classes,
            "assignedSubjects" => $assigned,
            "faculty" => $faculty,
            "assignedTeachers" => $assignedTeachers
        ]);
    }






    /**
      * Method: assign_teacher
      * Description: Funtion to assign a teacher to a class.
    */




    public function assign_teacher(AssignTeacherRequest $request)
    {



            $teacher = AssignTeacher::where('sectionId', $request->secId)
                                    ->where('facultyId', $request->teacherId)
                                    ->where('subjectId', $request->subjectId)
                                    ->get();

            $teacherI = Faculty::find($request->teacherId);
            $subjectI = Subject::find($request->subjectId);
            $sectionI = Section::find($request->secId);
            $classI = Classes::find($request->classId);


        if($teacher->count() == 0){
            AssignTeacher::create(['sectionId'=>$request->secId, 'facultyId'=>$request->teacherId, 'subjectId'=>$request->subjectId]);

            $notification = 'You have been assigned to Class '.$classI->class. ' Section '.$sectionI->sec;
            teacherNotification::create(['facultyId'=> $request->teacherId, 'notification' => $notification, 'link' => '#']);

            Session::flash('success', 'Teacher '.$teacherI->name.' has been assigned to Class '.$classI->class. ' Section '. $sectionI->sec. ' for Subject '. $subjectI->name);
        }
        else {
            Session::flash('danger', 'Teacher '.$teacherI->name.' is already assigned to Class '.$classI->class. ' Section '. $sectionI->sec. ' for Subject '. $subjectI->name);
        }




        return redirect('assign_teacher');
    }



    /**
      * Method: assign_teacher_remove
      * Description: Function to unassign a teacher, from a subject it is assigned.
    */

    public function assign_teacher_remove($subjectId, $facultyId, $sectionId){
        AssignTeacher::where('sectionId', $sectionId)
                        ->where('facultyId', $facultyId)
                        ->where('subjectId', $subjectId)
                        ->delete();

    $section = Section::find($sectionId);
    $faculty = Faculty::find($facultyId);
    $subject = Subject::find($subjectId);

    $class_id = $section->classId;
    $class = Classes::find($class_id);



     Session::flash('danger', 'Teacher '.$faculty->name. ' has been unassigned from Class '.$class->class. ' Section '.$section->sec. ' for Subject '.$subject->name);

        return redirect('assign_teacher');

    }




    /* 
        Method: getCalendarForm
        Description: To fetch calendar form as an ajax request
    */

    public function getCalendarForm(){
        return view('includes.getCalendarForm');
    }


    // Calender Function 


    public function manage_calender(){
        return view('pages.manage_calender');
    }





}
