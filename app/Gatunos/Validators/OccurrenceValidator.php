<?php namespace Gatunos\Validators;

class OccurrenceValidator extends Validator {

    public static $rules = array(
        'location' => 'required',
        'sighting_time' => 'required',
        'thief' => 'required',
    );

}