@extends('template.main')

@section('content')


<div class="container">
    @if(Session::has('message'))
    <div class="alert">
        <div class="alert alert-success">
            <p>{{ Session::get('message') }}</p>
        </div>
    </div>
    @endif
    @if($errors->has())
    @foreach($errors->all() as $message)
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endforeach
    @endif
    <?php $counter = 0; ?>
    @foreach($occurrences as $occurrence)
    <ul class="timeline">
        <li @if($counter%2!=0) class="timeline-inverted" @endif>
            <div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">{{ $occurrence->thief }}</h4>
                    <p>
                        <small class="text-muted" title="{{ $occurrence->sighting_time }}"><i class="glyphicon glyphicon-time"></i>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $occurrence->sighting_time, 'Europe/Lisbon')->diffForHumans() }} via @if($occurrence->anonymous) Anónimo @else {{ $occurrence->user()->get()->toArray()[0]['name'] }} @endif
                        </small>
                    </p>
                </div>
                <div class="timeline-body">
                    <p><strong>Localização:</strong> {{ $occurrence->location }}</p>
                    @if( strlen($occurrence->additional_information) > 0)
                        <br />
                        <p><strong>Informação adicional:</strong> {{ $occurrence->additional_information }}</p>
                    @endif

                </div>
            </div>
        </li>
        <?php $counter++; ?>
        @endforeach
    </ul>
    <div class="row">
        <div class="col-md-2 col-md-offset-5">
            {{ $occurrences->links(); }}
        </div>
    </div>




</div>
@stop