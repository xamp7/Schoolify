<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignTeacher extends Model
{
  protected $table = 'assignteacher';

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subjectId', 'sectionId', 'facultyId'
    ];
}
