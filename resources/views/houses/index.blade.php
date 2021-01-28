@extends('layouts.app')
@section('pageTitle', 'Aanbod')
@section('navbar-top')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                @if(count($houses) > 0)
                    <table>
                        <thead>
                        <tr>
                            <th>
                                Afbeelding
                            </th>
                            <th>
                                Naam
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Oppervlakte
                            </th>
                            <th>
                                Aantal kamers
                            </th>
                            <th>
                                Prijs
                            </th>
                            <th>
                                Status
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($houses as $key => $house)
                            <tr>
                                <td>
                                    <img style="max-height: 50px;" src="{{URL::to('/')}}/storage/{{ $house->image }}" alt="">
                                </td>
                                <td>
                                    {{ $house->name }}
                                </td>
                                <td>
                                    @if($house->status !== 3)
                                        @switch($house->type)
                                            @case(1)
                                            Rijtjeshuis
                                            @break
                                            @case(2)
                                            Appartement
                                            @break
                                            @case(3)
                                            Vrijstaand
                                        @endswitch
                                    @endif
                                </td>
                                <td>
                                    @if($house->status !== 3)
                                        {{ $house->surface }} m&#178;
                                    @endif
                                </td>
                                <td>
                                    @if($house->status !== 3)
                                        {{ $house->rooms }}
                                    @endif
                                </td>
                                <td>
                                    @if($house->status !== 3)
                                        &euro; {{ $house->price }}
                                    @endif
                                </td>
                                <td>
                                    @switch($house->status)
                                        @case(1)
                                            In verkoop
                                        @break
                                        @case(2)
                                            In optie/verkocht onder voorbehoud
                                        @break
                                        @case(3)
                                            Verkocht
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    Geen beschikbaarheid
                @endif
            </div>
        </div>
    </div>
@endsection
