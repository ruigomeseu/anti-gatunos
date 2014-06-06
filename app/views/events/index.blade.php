@extends('template.main')

@section('content')
<script>
    function initialize() {
        var feupCoords = new google.maps.LatLng(41.177875,-8.597916);
        var mapOptions = {
            zoom: 14    ,
            center: feupCoords
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);


        @foreach($occurrences as $occurrence)
            @if(!empty($occurrence->latitude) && !empty($occurrence->longitude))
                var markerlabel{{ $occurrence->id }}= new google.maps.InfoWindow({
                    content: "<p>{{ $occurrence->thief }}</p><p>{{ trim(preg_replace('/\s+/', ' ', nl2br($occurrence->additional_information))) }}</p>"
                });
                var marker{{$occurrence->id}} = new google.maps.Marker({
                    position: new google.maps.LatLng({{ $occurrence->latitude }}, {{ $occurrence->longitude }} ),
                    map: map,
                    title: "{ $occurrence->thief }}"
                });

                google.maps.event.addListener(marker{{$occurrence->id}}, "click", function (e) { markerlabel{{ $occurrence->id }}.open(map, this); });
            @endif
        @endforeach

    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>

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

    <div class="row">
        <div class="col-md-6">
            <a href="tel:+351225574900" class="btn btn-success btn-lg btn-block">Ligar Esquadra Bom Pastor</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="sms:+351912233377" class="btn btn-success btn-lg btn-block">SMS Seguranças FEUP</a>
            </div>
        </div>
    </div>

    <br />

    <div class="row">
        <div class="col-md-12">
            <div id="map-canvas"></div>
        </div>
    </div>

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