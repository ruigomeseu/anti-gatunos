@extends('template.main')

@section('content')
<script>
    var occurrences = {{ $geoOccurrencesJson }};
    function initialize() {
        var feupCoords = new google.maps.LatLng(41.177875,-8.597916);
        var mapOptions = {
            zoom: 14,
            center: feupCoords
        }

        var occurrences = {{ $geoOccurrencesJson }};

        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        for (occurrence in occurrences) {
            var label = new google.maps.InfoWindow({
                content: occurrences[occurrence].additional_information
            });

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(occurrences[occurrence].latitude, occurrences[occurrence].longitude),
                title: occurrences[occurrence].thief
            });

            marker.setMap(map);

            google.maps.event.addListener(marker, "click", function (e) { label.open(map, this); });
        }
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
        <div class="col-md-6">
            <a href="sms:+351912233377" class="btn btn-success btn-lg btn-block">SMS Seguranças FEUP</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <a href="tel:+351229059580" class="btn btn-success btn-lg btn-block">Ligar Esquadra S. Mamede Infesta</a>
        </div>
        <div class="col-md-6">
            <a href="sms:+351935664771" class="btn btn-success btn-lg btn-block">SMS Vigilância ISCAP</a>
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