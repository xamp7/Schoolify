<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class GenericController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth:faculty,students');
    }


  /**
    * Method: setting
    * Description: To display the view for Setting
  */

  public function setting(){

      $user = Auth::user();

      return view('pages.settings');
  }




  /**
    * Method: changeSettings
    * Description: To change the settings of the user i.e Password
  */

  public function changeSettings(Request $request){
      $userId = \Auth::id();
      if(Auth::guard('students')->check()){
          if($request->nPassword == $request->nRPassword){
            if(Hash::check($request->cPassword, Auth::user()->password )){
                \DB::table('students')
                      ->where('id', $userId)
                      ->update(['password' => Hash::make($request->nPassword) ]);

                \Session::flash('flash_message', 'Your password has been updated !');
            }

            else {
              \Session::flash('flash_message', 'The password is invalid !');
           }

       }
       else {
          \Session::flash('flash_message', 'Your passwords do not match !');
        }
      }

      else {
          if($request->nPassword == $request->nRPassword){
              if(Hash::check($request->cPassword, Auth::user()->password )){
                  \DB::table('faculties')
                        ->where('id', $userId)
                        ->update(['password' => Hash::make($request->nPassword) ]);

                  \Session::flash('flash_message', 'Your password has been updated !');
              }

              else {
                \Session::flash('flash_message', 'The password is invalid !');
             }

         }
         else {
            \Session::flash('flash_message', 'Your passwords do not match !');
          }


      }



      return redirect('settings');


  }


  /**
    * Method: update_notificationCount
    * Description: To update the notificationCount in table faculty_notfications
  */

  public function update_notificationCount(){

    if(Auth::guard('students')->check()){
      $studentId = \Auth::id();

      \DB::table('student_notifications')
            ->where('studentId', $studentId)
            ->update(['seen' => '1']);

    }

    else {
      $facultyId = \Auth::id();

      \DB::table('faculty_notifications')
            ->where('facultyId', $facultyId)
            ->update(['seen' => '1']);

    }

      return 'Count: 10';
  }









  /**
    * Method: upload_image
    * Description: Function to upload an image
  */

  public function upload_image(Request $request){
          $this->validate($request, [
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

         $image = $request->file('image');
         $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         $destinationPath = public_path('/images');
         $image->move($destinationPath, $input['imagename']);


  }











}
