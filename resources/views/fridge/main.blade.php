@extends('../components.layout')

@section('title', 'Hlavní nabídka')

@section('content')
    <a href="/lednicka/public/fridge/add">Přidat potravinu do lednice</a>
    <h1>Hlavní nabídka</h1>
    <p>
        @if(empty($items))

            Žádná data nebyla nalezena.

            @else
                <section class="products">
                @foreach($items as $item)
                    <a href="/lednicka/public/fridge/detail/{{$item->id}}">
                        <div class="products__item">
                            <img src="/lednicka/public/images/{{$item->fotka}}" onerror="this.src = '/lednicka/public/images/noimage.png'" height="200px" alt="Obrázek produktu">
                            <h3>{{$item->nazev}}</h3> 
                            <ul>
                                @if(($item->datum_spotreby ? strtotime($item->datum_spotreby) : strtotime($item->datum_trvanlivost)) < strtotime("now"))
                                    <li class="red">Prošlé zboží (do {{date("d.m.Y H:i", ($item->datum_spotreby ? strtotime($item->datum_spotreby) : strtotime($item->datum_trvanlivost)))}})</li>
                                @elseif(strtotime($item->polocas_spotreby) <= strtotime("now"))
                                     <li class="orange">Blížící se expirace - {{date("d.m.Y H:i", ($item->datum_spotreby ? strtotime($item->datum_spotreby) : strtotime($item->datum_trvanlivost)))}}</li>
                                @else
                                     <li>Spotřebujte do {{date("d.m.Y H:i", ($item->datum_spotreby ? strtotime($item->datum_spotreby) : strtotime($item->datum_trvanlivost)))}}</li>
                                @endif
                                <li>Poločas spotřeby: {{date("d.m.Y H:i", strtotime($item->polocas_spotreby))}}</li>
                            </ul>
                        </div>
                    </a>
                @endforeach
                </section>

                <section class="pages">
                    @if($page > 1)
                        <a href="/lednicka/public/main/{{$page-1}}">←</a> 
                    @endif
                    @if($page < $page_count) 
                        <a href="/lednicka/public/main/{{$page+1}}">→</a>
                    @endif
                    <p>
                        Stránka {{$page}} / {{$page_count}}
                    </p>
                </section>
        @endif
    </p>
@endsection