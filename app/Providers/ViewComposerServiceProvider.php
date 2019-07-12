<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
          $this->feedBackComposer();
          $this->notificationComposer();
          $this->auth_info();

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    private function feedBackComposer(){
        view()->composer('includes.topnav', function($view){
            $facultyId = \Auth::id();
            $feedbacks = \DB::table('parentsfeedback')
                            ->where('facultyId', $facultyId)
                            ->where('seen', 0)
                            ->orderBy('id', 'desc')
                            ->get();


            $view->with('feedbacks', $feedbacks);
        });
    }



    /**
      * Method: notificationComposer
      * Description: To send the notifications data to all views
    */

    public function notificationComposer(){


      view()->composer('includes.topnav', function($view){

          if(Auth::guard('students')->check()){
              $studentId = \Auth::id();
              $notifications = \DB::table('student_notifications')
                              ->where('studentId', $studentId)
                              ->where('seen', 0)
                              ->orderBy('id', 'desc')
                              ->get();

          }
          else {
              $facultyId = \Auth::id();
              $notifications = \DB::table('faculty_notifications')
                              ->where('facultyId', $facultyId)
                              ->where('seen', 0)
                              ->orderBy('id', 'desc')
                              ->get();
          }



          $view->with('notifications', $notifications);
      });
    }



    /**
      * Method: auth_info
      * Description: Send auth information to sidebar views
    */

    public function auth_info(){
      view()->composer('*', function($view){

          $user = \Auth::user();
          // dd($user);
        $view->with('user', $user);
      });
    }










}
