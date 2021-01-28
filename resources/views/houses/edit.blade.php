@extends('layouts.app')
@section('pageTitle', $house->name .' Aanpassen')
@section('navbar-top')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(!empty($house) > 0)
            <div class="col-6">
                <img class="house-image" src="{{URL::to('/')}}/storage/{{ $house->image }}" alt="Huidige afbeelding"><br>
            </div>
           <div class="col-6">
                   <form action="/dashboard/edit" method="POST" enctype="multipart/form-data">
                       @csrf
                       {{ method_field('PUT') }}
                       <div class="form-group">
                           <input id="file" class="sr-only" type="number" name="id" value="{{ $house->id }}">
                           <label for="file">Afbeelding wijzigen (of laat leeg):</label><br>
                           <input type="file" name="file">
                       </div>
                       <div class="form-group">
                           <label for="name">Naam</label><br>
                           <input id="name" type="text" name="name" value="{{ $house->name }}" placeholder="{{ $house->name }}">
                       </div>
                       <div class="form-group">
                           <label for="type">Type huis</label><br>
                           <select name="type" id="type">
                               <option value="1" <?= ($house->type == 1 ? 'selected="selected"' : '') ?>>Rijtjeshuis</option>
                               <option value="2" <?= ($house->type == 2 ? 'selected="selected"' : '') ?>>Appartement</option>
                               <option value="3" <?= ($house->type == 3 ? 'selected="selected"' : '') ?>>Vrijstaand</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="surface">Oppervlakte in &#178;</label><br>
                           <input id="surface" type="number" name="surface" value="{{ $house->surface }}" placeholder="{{ $house->surface }} m&#178;">
                       </div>
                       <div class="form-group">
                           <label for="rooms">Aantal kamers</label><br>
                           <input id="rooms" type="number" name="rooms" value="{{ $house->rooms }}" placeholder="{{ $house->rooms }}">
                       </div>
                       <div class="form-group">
                           <label for="price">Prijs</label><br>
                           <input id="price" type="number" name="price" value="{{ $house->price }}" placeholder="{{ $house->price }}">
                       </div>
                       <div class="form-group">
                           <label for="status">Status</label><br>
                           <select name="status" id="status">
                               <option value="1" <?= ($house->status == 1 ? 'selected="selected"' : '') ?>>In verkoop</option>
                               <option value="2" <?= ($house->status == 2 ? 'selected="selected"' : '') ?>>In optie/verkocht onder voorbehoud</option>
                               <option value="3" <?= ($house->status == 3 ? 'selected="selected"' : '') ?>>Verkocht</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <button>Aanpassen</button>
                       </div>
                   </form>
           </div>
            @endif
        </div>
    </div>
@endsection




