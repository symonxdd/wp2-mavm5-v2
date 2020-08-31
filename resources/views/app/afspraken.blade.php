@extends('layouts.master')
@section('title', 'Afspraken')
@section('styles')
<link rel="stylesheet" href="{{ URL::asset('src/css/afspraken.css') }}">
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

    

    <div id="container" class="table">

        @if(count($errors) > 0)
        <div id="form-error" class="alert alert-warning">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <div id="pagination">
            {{ $afspraken->links() }}
        </div>
        
        <table class="table table-hover table-striped table-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Voornaam</th>
                    <th scope="col">Naam</th>
                    <th scope="col">
                        <div class="item" title="Contact met coronavirus">
                            <a href="#">
                                <span class="notify-badge">?</span>
                                <img id="virus" src="{{ URL::asset('src/img/virus.svg') }}" alt="virus">
                            </a>
                        </div>
                    </th>
                    {{-- <a href="{{ route('sort.date') }}"></a> --}}
                    <th scope="col">Datum</th>
                    <th scope="col">Tijdstip</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($afspraken->chunk(3) as $afspraakChunk)
                @foreach($afspraakChunk as $afspraak)
                <tr>
                    <form action="{{ route('afspraak.wijzig') }}" method="post">
                        <td scope="row">{{ $afspraak->id }}</td>
                        <td><input type="text" name="voornaam" id="voornaam" value="{{ $afspraak->voornaam }}" class="form-control form-control-sm"></td>
                        <td><input type="text" name="naam" id="naam" value="{{ $afspraak->naam }}" class="form-control form-control-sm"></td>
                        <td>
                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input corona" id="{{ $afspraak->id }}" aria-describedby="coronaHelp">
                                <label class="custom-control-label" for="{{ $afspraak->id }}">
                                    <span id="switch-text">Nee</span>
                                </label>
                                <input type="hidden" name="corona" value="{{ $afspraak->contact_met_coronavirus == 0 ? 0 : 1}}">
                            </div>
                        </td>
                        <td>
                            <input type="date" id="date" name="datum" class="form-control form-control-sm" value="{{$afspraak->datum}}">
                        </td>
                        <td>
                            <input type="time" id="tijdstip" name="tijdstip" class="form-control form-control-sm" value="{{ $afspraak->tijdstip }}" min="07:00" max="20:00"></td>
                        <td>
                            <input type="submit" name="action" value="e" alt="edit" id="edit" class="form-control form-control-sm bg-transparent text-black-0">
                        </td>
                        <td>
                            <input type="submit" name="action" value="d" alt="delete" id="delete" class="form-control form-control-sm bg-transparent">
                        </td>
                        
                        <input type="hidden" name="afspraak_id" value="{{$afspraak->id}}">
                        {{ csrf_field() }}
                    </form>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
      </div>

@endsection
@section('scripts')
    <script src="{{ URL::asset('src/js/afspraken.js') }}"></script>
@endsection