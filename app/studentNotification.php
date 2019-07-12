<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentNotification extends Model
{
  protected $table = 'student_notifications';

  protected $fillable = [
      'studentId', 'notification', 'link'

  ];

}
