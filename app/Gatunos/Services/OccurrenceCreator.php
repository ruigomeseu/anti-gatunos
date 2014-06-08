<?php namespace Gatunos\Services;

use Gatunos\Exceptions\ValidationException;
use Gatunos\Validators\OccurrenceValidator;
use Occurrence;

class OccurrenceCreator {

    protected $validator;

    function __construct(OccurrenceValidator $validator)
    {
        $this->validator = $validator;
    }

    public function make(array $data)
    {
        if ($this->validator->isValid($data))
        {
            $occurrence = Occurrence::create($data);

            if(strlen($data['exact_address']) > 0) {
                $geocode = Geocoder::geocode($data['exact_address']);

                $occurrence->latitude = $geocode->getLatitude();
                $occurrence->longitude = $geocode->getLongitude();
                $occurrence->save();
            }

            return true;

        }

        throw new ValidationException('Occurrence Validation Failed', $this->validator->getErrors());
    }
} 