@extends('../components.layout')

@section('title', 'Přidání potraviny')

@section('content')
    <form action="/lednicka/public/fridge/add" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="nazev" type="text" placeholder="Potravina *" required="true" />
        
        <label for="vyroba">
            Datum výroby
        </label>
        <input name="datum_vyroby" type="datetime-local" max="{{date("Y-m-d\TH:i", strtotime("now")+86400)}}"/>
        
        <label for="nakup">
            Datum nákupu *
        </label>
        <input id="nakup" name="datum_nakupu" type="datetime-local" required="true" max="{{date("Y-m-d\TH:i", strtotime("now")+86400)}}" />
        
        <label for="trvanlivost">
            Datum minimální trvanlivosti *
        </label>
        <input id="trvanlivost" name="datum_trvanlivost" type="datetime-local" required="true" min="{{date("Y-m-d\TH:i", strtotime("now"))}}" />

        <label for="spotreba">
            Datum spotřeby
        </label>
        <input id="spotreba" name="datum_spotreby" type="datetime-local" min="{{date("Y-m-d\TH:i", strtotime("now"))}}" />

        <label for="fotka">
            Obrázek
        </label>
        <input type="file" id="fotka" name="fotka" accept="image/jpeg, image/png, image/svg">
        
        <input type="submit" name="fridge_add_item" value="Přidat potravinu" />
    </form> 

@endsection