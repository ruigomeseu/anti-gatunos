<?php namespace Gatunos\Validators;

abstract class Validator {

    protected $errors;

    public function isValid(array $data)
    {
        $validator = \Validator::make($data, static::$rules);

        if($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }

        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

} 