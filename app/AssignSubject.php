<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
  protected $table = 'assignsubject';

/**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'subjectId', 'classId'
  ];
}
