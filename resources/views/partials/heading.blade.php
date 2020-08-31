<span id="software-version" class="text-white">Software v.2.3.5</span>

<nav id="navigation-bar" class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="{{ route('afspraak.index') }}">
        <img src="{{ URL::to('src/img/caduceus.svg') }}" height="100" class="d-inline-block align-top" alt="">
    </a>
    
        <span id="hoofd-tekst">Praktijk Adélie Ménard</span>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <br>
        <ul id="navigation" class="navbar-nav ml-auto mr-1">
            <li class="nav-item">
                <a class="nav-link {{ '/' == request()->path() ? 'active text-white' : 'inactive'}}" href="{{ route('afspraak.index') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ 'afspraken' == request()->path() ? 'active text-white' : 'inactive'}}" href="{{ route('afspraak.afspraken') }}">Afspraken</a>
            </li>
        </ul>
    </div>
</nav>