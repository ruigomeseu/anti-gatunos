<?php

class Profile extends BaseModel {

    public function user()
    {
        return $this->belongsTo('User');
    }
}