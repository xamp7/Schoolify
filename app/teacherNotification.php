<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacherNotification extends Model
{
  protected $table = 'faculty_notifications';


  protected $fillable = [
      'facultyId', 'notification', 'link'

  ];

}
