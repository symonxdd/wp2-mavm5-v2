@extends('layouts.master')
@section('title', 'Home | Praktijk Adélie Ménard')
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('src/css/index.css') }}">
@endsection

@section('content')
    {{-- @if(Session::has('success'))
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="charge-message" class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @endif --}}

    <form action="{{ route('afspraak.add') }}" method="post" class="col-lg-6">

        @if(count($errors) > 0)
        <div id="form-error" class="alert alert-warning" role="alert">
            @foreach($errors->all() as $error)
            <span>{{ $error }}</span><br>
            @endforeach
        </div>
        @endif

        @csrf

        <h2>Ingelogd als Alicia Del Rosario</h2>
        <h3 class="text-white">Maak een afspraak</h3>
        <div id="border">
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="voornaam">Voornaam</label>
                    <input type="text" class="form-control" id="voornaam" name="voornaam" value="{{ old('voornaam') }}" pattern="[A-Za-z]{3,50}" title="Mag alleen tekst zijn; tussen 3->50">
                </div>
                <div class="form-group col-sm-6">
                    <label for="naam">Naam</label>
                    <input type="text" class="form-control" id="naam" name="naam" value="{{ old('naam') }}" pattern="[A-Za-z{3,50}" title="Mag alleen tekst zijn 3->50">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                <label for="datum">Datum</label>
                <input type="date" class="form-control" id="datum" name="datum" value="{{ old('datum') }}">
                </div>
                <div class="form-group col-3">
                <label for="tijdstip">Tijdstip</label>
                <input type="time" class="form-control" id="tijdstip" name="tijdstip" value="{{ old('tijdstip') }}">
                </div>
            </div>

            <div class="form-group">
                <small id="coronaHelp" class="form-text">Patient had contact met coronavirus</small>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="corona" aria-describedby="coronaHelp">
                    <input type="hidden" name="corona" value="{{ old('corona') == null ? 0 : old('corona')}}">

                    
                    <label class="custom-control-label" for="corona">
                        <span id="switch-text">Nee</span>
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary text-white">Voeg toe</button>
        </div>
        
      </form>
      
@endsection

@section('scripts')
    <script src="{{ URL::asset('src/js/index.js') }}"></script>
@endsection