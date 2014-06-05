@extends('template.main')

@section('content')

<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>Adicionar Ocorrência</h1>
        <br/>
        @if(Session::has('message'))
        <div class="alert">
            {{ Session::get('message') }}
        </div>
        @endif
        @if($errors->has())
        @foreach($errors->all() as $message)
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        @endforeach
        @endif
        {{ Form::open(array("url"=>"occurrences/add", "id" => "addEvent")) }}

        <p>{{ Form::text('location', Input::old('location'), array("placeholder" => "Localização Aproximada", "class" => "form-control")) }}</p>

        <p>{{ Form::text('exact_address', Input::old('exact_address'), array("placeholder" => "Morada Exacta (não obrigatório)", "class" => "form-control")) }}</p>

        <p>{{ Form::text('sighting_time', '', array("placeholder" => "Hora", "class" => "form-control timepicker")) }}


        <p>{{ Form::select('thief', array('Pinxinhas' => 'Pinxinhas', 'Piu Piu' => 'Piu Piu', 'Colt' => 'Colt',
            'Laranjas' => 'Laranjas', 'Rodolfo' => 'Rodolfo', 'Banana' => 'Banana', 'Nuno Miguel' => 'Nuno Miguel',
            'Joao Fernandes aka Banana' => 'Joao Fernandes aka Banana', 'Outro' => 'Outro' ), null, array("placeholder" => "Localização",
            "class" => "form-control")) }}</p>

        <p>{{ Form::textarea('additional_information', Input::old('additional_information'), array("placeholder" => "Informação Adicional",
            "class" => "form-control")) }}</p>
        <div class="checkbox">
            <label>
                <input name="anonymous" type="checkbox" value="1" checked> Publicar anonimamente
            </label>
        </div>



        <button type="submit" class="btn btn-default">Submeter</button>
    </div>

</div> <!-- /container -->

<script>
    $(function () {
        var MS_PER_MINUTE = 60000;
        var minDate = new Date(Date.now() - 60 * MS_PER_MINUTE);

        minDate.setMinutes( minDate.getMinutes() - minDate.getMinutes() % 5 );

        $('.timepicker').pickatime({
            min: minDate,
            max: new Date(Date.now() + 5 * MS_PER_MINUTE),
            interval: 5
        })
    });
</script>
@stop