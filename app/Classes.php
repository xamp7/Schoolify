<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
  protected $table = 'classes';

/**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'class', 'totalStrength'
  ];


}
