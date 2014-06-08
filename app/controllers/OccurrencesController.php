<?php

use \Gatunos\Services\OccurrenceCreator;

class OccurrencesController extends \BaseController {

    protected $occurrenceCreator;

    function __construct(OccurrenceCreator $occurrenceCreator)
    {
        $this->occurrenceCreator = $occurrenceCreator;
    }

    /**
	 * Display a listing of the resource.
	 * GET /occurrences
	 *
	 * @return Response
	 */
	public function index()
	{
        $occurrences = Occurrence::orderBy('sighting_time', 'DESC')->with('user')->paginate(20);
        return View::make('occurrences.index')->with(
            array(
                'title' => 'Todas as Ocorrências',
                'occurrences' => $occurrences,
            ));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /occurrences/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('occurrences.create')->with('title','Adicionar Ocorrência');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /occurrences
	 *
	 * @return Response
	 */
	public function store()
	{
        try {
            $this->occurrenceCreator->make(Input::all());
        } catch(\Gatunos\Exceptions\ValidationException $e) {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        return Redirect::route('home')
            ->with('message', 'Ocorrência registada!');

	}

}