<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Core Values') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li><a class="nav-link" href="{{ route('about.index') }}">{{ __('About') }}</a></li>
                <li><a class="nav-link" href="{{ route('advanced.index') }}">{{ __('Advanced') }}</a></li>
            </ul>
        </div>
    </div>
</nav>
