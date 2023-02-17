<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interview Test</title>
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>
<body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">Forum</a>
          <div>
            @guest
              <a class="navbar-access" href="{{ route('login') }}">Login</a>
              <a class="navbar-access" href="{{ route('register') }}">Register</a>
            @else
              <span id="username">{{ auth()->user()->name }}</span>
              <a class="navbar-access" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            @endguest
          </div>
        </div>
      </nav>
    </header>

    <div class="container mt-4">
      @yield('content')
    </div>
    @yield('scripts')
</body>
</html>