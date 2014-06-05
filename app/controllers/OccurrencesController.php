<?php

class OccurrencesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /events
	 *
	 * @return Response
	 */
	public function index()
	{

        $occurrences = Occurrence::orderBy('sighting_time', 'DESC')->with('user')->paginate(20);
        return View::make('events.index')->with(
            array(
                'title' => 'Todas as Ocorrências',
                'occurrences' => $occurrences,
            ));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /events/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('events.create')->with('title','Adicionar Ocorrência');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /events
	 *
	 * @return Response
	 */
	public function store()
	{
        $validation = Occurrence::validate(Input::all());
        if($validation->passes()) {


            $occurrence = new Occurrence();

            if(strlen(Input::get('exact_address')) > 0) {
                try {
                    $geocode = Geocoder::geocode(Input::get('exact_address'));

                } catch (\Exception $e) {
                    return Redirect::route('addOccurrence')
                        ->withErrors($e->getMessage())
                        ->withInput();
                }

                $occurrence->latitude = $geocode->getLatitude();
                $occurrence->longitude = $geocode->getLongitude();
                $occurrence->exact_address = Input::get('exact_address');
            }

            $occurrence->user_id = Auth::user()->id;
            $occurrence->location = Input::get('location');
            $occurrence->thief = Input::get('thief');
            $occurrence->sighting_time = date('Y-m-d H:i:s', strtotime(Input::get('sighting_time')));
            $occurrence->additional_information = Input::get('additional_information');
            $occurrence->anonymous = Input::get('anonymous');


            $occurrence->save();

            return Redirect::route('home')
                ->with('message', 'Ocorrência registada!');

        } else {
            return Redirect::route('addOccurrence')
                ->withErrors($validation)
                ->withInput();
        }
	}

	/**
	 * Display the specified resource.
	 * GET /events/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /events/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /events/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /events/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}