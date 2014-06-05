<?php

class Occurrence extends BaseModel {

    public static $rules = array(
        'location' => 'required',
        'sighting_time' => 'required',
        'thief' => 'required',
    );

    public function user()
    {
        return $this->belongsTo('User');
    }

}