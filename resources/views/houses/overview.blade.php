@extends('layouts.app')
@section('navbar-top')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3">
                <h2>Nieuw huis toevoegen</h2>
                <form action="/dashboard/add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Afbeelding</label>
                        <input type="file" name="file">
                    </div>
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" name="name" value="" placeholder="Naam">
                    </div>
                    <div class="form-group">
                        <label for="type">Type huis</label>
                        <select name="type" id="type">
                            <option value="1">Rijtjeshuis</option>
                            <option value="2">Appartement</option>
                            <option value="3">Vrijstaand</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="surface">Oppervlakte in m&#178;</label>
                        <input type="number" name="surface" value="" placeholder="0m&#178;">
                    </div>
                    <div class="form-group">
                        <label for="rooms">Aantal kamers</label>
                        <input type="number" name="rooms" value="" placeholder="Aantal kamers">
                    </div>
                    <div class="form-group">
                        <label for="price">Prijs</label>
                        <input type="number" name="price" value="" placeholder="Prijs">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="1">In verkoop</option>
                            <option value="2">In optie/verkocht onder voorbehoud</option>
                            <option value="3">Verkocht</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button>Upload</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-9">
                <h2>
                    Overzicht
                </h2>
                @if(count($houses) > 0)
                    <table>
                        <thead>
                        <tr>
                            @auth
                                <th></th>
                            @endauth
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
                            @auth
                                <th></th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($houses as $key => $house)
                            <tr>
                                @auth
                                    <td>
                                        <form method="POST" action="/dashboard/delete">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input class="sr-only" type="number" name="id" value="{{ $house->id }}">
                                            <input type="submit" class="delete-btn" value="Verwijderen">
                                        </form>
                                    </td>
                                @endauth
                                <td>
                                    <img style="max-height: 50px;" src="{{URL::to('/')}}/storage/{{ $house->image }}" alt="">
                                </td>
                                <td>
                                    {{ $house->name }}
                                </td>
                                <td>
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
                                </td>
                                <td>
                                    {{ $house->surface }} m&#178;
                                </td>
                                <td>
                                    {{ $house->rooms }}
                                </td>
                                <td>
                                    &euro; {{ $house->price }}
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
                                @auth
                                    <td>
                                        <a href="/dashboard/{{ $house->id }}">Aanpassen</a>
                                    </td>
                                @endauth
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

@section('scripts')
    <script>
		$('.delete-btn').click(function(e){
			e.preventDefault();
			if (confirm('Zeker weten?')) {
				$(e.target).closest('form').submit();
			}
		});
    </script>
@endsection


