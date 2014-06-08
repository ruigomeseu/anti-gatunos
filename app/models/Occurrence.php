<?php

class Occurrence extends Eloquent {

    protected $fillable = array('user_id', 'location', 'thief', 'sighting_time', 'anonymous', 'additional_information', 'exact_address');

    public function user()
    {
        return $this->belongsTo('User');
    }

}