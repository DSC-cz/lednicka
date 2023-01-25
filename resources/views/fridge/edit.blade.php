@extends('../components.layout')

@section('title', 'Úprava potraviny')

@section('content')
    <a href="/lednicka/public/fridge/detail/{{$id}}">← Zpět na detail</a>
    <form action="/lednicka/public/fridge/edit/{{$id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="nazev" type="text" placeholder="Potravina *" value="{{$item->nazev}}" required="true" />
        
        <label for="vyroba">
            Datum výroby
        </label>
        <input name="datum_vyroby" type="datetime-local" 
        @if($item->datum_vyroby)
        value="{{date("Y-m-d\TH:i", strtotime($item->datum_vyroby))}}"
        max="{{date("Y-m-d\TH:i", strtotime(($item->datum_spotreby ? $item->datum_spotreby : $item->datum_trvanlivost)))}}"
        @endif
        />
        
        <label for="nakup">
            Datum nákupu *
        </label>
        <input id="nakup" name="datum_nakupu" type="datetime-local" required="true" 
        value="{{date("Y-m-d\TH:i", strtotime($item->datum_nakupu))}}" 
        max="{{date("Y-m-d\TH:i", strtotime(($item->datum_spotreby ? $item->datum_spotreby : $item->datum_trvanlivost)))}}" />
        
        <label for="trvanlivost">
            Datum minimální trvanlivosti *
        </label>
        <input id="trvanlivost" name="datum_trvanlivost" type="datetime-local" required="true"  
        value="{{date("Y-m-d\TH:i", strtotime($item->datum_trvanlivost))}}"
        min="{{date("Y-m-d\TH:i", strtotime(($item->datum_vyroby ? $item->datum_nakupu : $item->datum_nakupu)))}}"
        />

        <label for="spotreba">
            Datum spotřeby
        </label>
        <input id="spotreba" name="datum_spotreby" type="datetime-local"
        @if($item->datum_spotreby)
        value="{{date("Y-m-d\TH:i", strtotime($item->datum_spotreby))}}"
        @endif
        min="{{date("Y-m-d\TH:i", strtotime(($item->datum_vyroby ? $item->datum_nakupu : $item->datum_nakupu)))}}"
        />

        <input type="hidden" name="aktualni_fotka" value="{{$item->fotka}}"/>
        <label for="fotka">
            Aktální obrázek:
            <img src="/lednicka/public/images/{{$item->fotka}}" onerror="this.src = '/lednicka/public/images/noimage.png'" height="100px" alt="Obrázek" />
        </label>
        <input type="file" id="fotka" name="fotka" accept="image/jpeg, image/png, image/svg">
        
        <input type="submit" name="fridge_edit_item" value="Upravit potravinu" />
    </form> 

@endsection