<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table = 'student';
    public $timestamps = true;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }
}