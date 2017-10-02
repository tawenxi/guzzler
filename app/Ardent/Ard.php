<?php

namespace App\Ardent;

use LaravelArdent\Ardent\Ardent;

class Ard extends Ardent
{
    protected $fillable = ['firstname', 'lastname'];
    public static $rules = [
    'firstname'=> 'required|between:3,80',
    'lastname'=> 'required|between:5,64', ];

    public static $customMessages = [
      'between' => 'The :attribute 太短了.', ];

    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    public function beforeSave()
    {
        $this->firstname = \Hash::make($this->firstname);
    }
}
