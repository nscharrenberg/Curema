<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" class="style">

    @yield('css')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
            @auth
                <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{route('client.invoices')}}">My Invoices</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Customer Service <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{route('client.tickets.index')}}">My Tickets</a>
                                    <a href="{{route('client.tickets.create')}}">Create new Ticket</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
            @endauth
            <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->

                    @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->firstname }} {{Auth::user()->lastname }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                </ul>
            </div>
        </div>
    </nav>
    @if(auth()->user()->id)
        <?php $announcements = \App\Announcement::user_announcements(); ?>
        @if(count($announcements) > 0)
            @foreach($announcements as $announcement)
                <div class="alert alert-info">
                    <div class="pull-right">{{$announcements->render()}}</div>
                    <p><strong>{{$announcement->subject}}</strong></p>
                    <p>{{$announcement->content}}</p>
                    @if($announcement->showMyName)
                        @if($announcement->admin->email_signature)
                        <p>{{$announcement->admin->email_signature}}</p>
                            @else
                            <p>{{$announcement->admin->fullName}}</p>
                            @endif
                        @endif
                </div>
                @endforeach
            @endif
        @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')

</body>
</html>
