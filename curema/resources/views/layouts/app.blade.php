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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/select.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" class="style">

    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-toggleable-md navbar-light-new bg-primary bg-faded sticky-top navbar-expand-md bottommargin-20">
            <button class="navbar-toggler navbar-toggler-right " type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">{{ config('app.name', 'Curema CRM') }}</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                @auth('admin')
                <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.customer.index')}}">Customers</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.invoice.index')}}">Invoices</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.estimates.index')}}">Estimates</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.expenses.index')}}">Expenses</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.contracts.index')}}">Contracts</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.leads.index')}}">Leads</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.employee.index')}}">Employees</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.tickets.index')}}">Tickets</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            UWV
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{route('admin.uwv.processes.index')}}">UWV Processes</a>
                            <a class="dropdown-item" href="{{route('admin.uwv.contacts.index')}}">UWV Contacts</a>
                            <a class="dropdown-item" href="{{route('admin.uwv.services.index')}}">UWV Services</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="settingsdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Settings
                        </a>
                        <div class="dropdown-menu" aria-labelledby="settingsdropdown">
                            <a class="dropdown-item" href="{{route('admin.payments.index')}}">Payment Methods</a>
                            <a class="dropdown-item" href="{{route('admin.tax.index')}}">Taxes</a>
                            <a class="dropdown-item" href="{{route('admin.leads.status.index')}}">Lead Status</a>
                            <a class="dropdown-item" href="{{route('admin.leads.sources.index')}}">Lead Sources</a>
                            <a class="dropdown-item" href="{{route('admin.contacts.types.index')}}">Contact Types</a>
                            <a class="dropdown-item" href="{{route('admin.expenses.categories.index')}}">Expense Categories</a>
                            <a class="dropdown-item" href="{{route('admin.departments.index')}}">Departments</a>
                            <a class="dropdown-item" href="{{route('admin.announcements.index')}}">Announcements</a>
                            <a class="dropdown-item" href="{{route('admin.contracts.types.index')}}">Contract Types</a>
                            <a class="dropdown-item" href="{{route('admin.tickets.priorities.index')}}">Ticket Priorities</a>
                            <a class="dropdown-item" href="{{route('admin.tickets.statuses.index')}}">Ticket Statuses</a>

                        </div>
                    </li>
                </ul>
                @endauth

                <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('admin.login')}}">Login</a>
                        </li>
                        @else

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-user"></span> {{ Auth::user()->firstname }} {{Auth::user()->lastname }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                            @endguest
                    </ul>
            </div>
        </nav>
        @if(auth()->check())
            @if(auth()->user()->admin)
                <?php $announcements = \App\Announcement::staff_announcements(); ?>
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
        @endif
            @yield('content')

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="{{asset('js/select.js')}}"></script>
    <script>
        $('select').extendSelect({
            // Search input placeholder:
            search: 'Find',
            // Title if option not selected:
            notSelectedTitle: 'Select an option',
            // Message if select list empty:
            empty: 'Empty',
            // Class to active element
            activeClass: 'active',
            // Class to disabled element
            disabledClass: 'disabled',
            // Custom error message for all selects (use placeholder %items)
            maxOptionMessage: 'Max %items elements',
            // Delay to hide message
            maxOptionMessageDelay: 2000,
            // Popover logic (resize or save height)
            popoverResize: true,
            // Auto resize dropdown by button width
            dropdownResize: true
        });
    </script>
    @yield('scripts')

</body>
</html>
