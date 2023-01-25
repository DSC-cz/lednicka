@extends('../components.layout')

@section('title', 'Detail produktu ')

@section('content')
    <a href="/lednicka/public/main">← Hlavní stránka</a>
    <h1>Detail produktu - {{$item[0]->nazev}}</h1>
    <table>
        <tbody>
            <tr><td rowspan="5" style="text-align:center">
                    <img src="/lednicka/public/images/{{$item[0]->fotka}}" onerror="this.src = '/lednicka/public/images/noimage.png'" width="300px" alt="Obrázek produktu" />
                </td>
                <td>Datum výroby: 
                    @if($item[0]->datum_vyroby)
                        {{date("d.m.Y H:i:s", strtotime($item[0]->datum_vyroby))}}
                        @else
                            <i>Neznámé</i>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Datum nákupu: 
                        {{date("d.m.Y H:i:s", strtotime($item[0]->datum_nakupu))}}
                </td>
            </tr>
            <tr>
                <td>Datum minimální trvanlivosti: 
                        {{date("d.m.Y H:i:s", strtotime($item[0]->datum_trvanlivost))}}
                </td>
            </tr>
            <tr>
                <td>Datum spotřeby: 
                    @if($item[0]->datum_spotreby)
                        {{date("d.m.Y H:i:s", strtotime($item[0]->datum_spotreby))}}
                        @else
                            <i>Neznámé</i>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Poločas spotřeby: {{date("d.m.Y H:i:s", strtotime($item[0]->polocas_spotreby))}}</td>
            </tr>
        </tbody>
    </table>

    <a href="/lednicka/public/fridge/edit/{{$item[0]->id}}"><button>Upravit produkt</button></a>
    <form action="#" method="POST">
        @csrf
        <button name="delete">Odstranit produkt</button>
    </form>
@endsection