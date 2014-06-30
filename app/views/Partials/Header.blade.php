
    <!-- Begin Header -->
    <div class="row header">
        <!--  Logo  -->
        <div class="span3 logo">
         <a href="{{ route('home') }}"><img src="assets/images/logo/logo-tv.png" alt="The Media Database" /><img src="assets/images/logo/logo-words.png" height="" width="130" alt="The Media Database"/></a></div>
        <!--  Start Menu  -->
        <!--  Start Computer Navigation  -->
        <div class="span9 navigation">
            <div class="navbar hidden-phone" role="navigation">
                <!--  All Users  -->
                <ul class="nav">
                    <li> <a href="{{ route('home') }}">{{ trans('main.home') }}</a> </li>
                    <li class="dropdown">
                        <a href="{{ url(Str::slug(trans('main.series'))) }}">{{ trans('main.series-menu') }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">TV Series</a></li>
                            <li><a href="#">TV Calendar</a></li>
                            <li><a href="#">TV Reviews</a></li>
                        </ul>
                    </li>
                    <li> <a href="{{ url(Str::slug(trans('main.movies'))) }}">{{ trans('main.movies-menu') }}</a> </li>
                    <li> <a href="{{ url(Str::slug(trans('main.news'))) }}">{{ trans('main.news-menu') }}</a> </li>
                    <li> <a href="{{ url(Str::slug(trans('main.people'))) }}">{{ trans('main.people-menu') }}</a> </li>

                   <!-- Navbar User Not Loged In -->
                   @if( ! Sentry::check())
                    <li><a href="{{ url(Str::slug(trans('main.register'))) }}">{{ trans('main.register-menu') }}</a></li>
                    <li><a href="{{ url(Str::slug(trans('main.login'))) }}">{{ trans('main.login-menu') }}</a></li>

                   @else
                   <!--Navbar Logged In Users-->
                   <li><a href="{{ Helpers::profileUrl() }}">{{{ Helpers::loggedInUser()->first_name ? Helpers::loggedInUser()->first_name : Helpers::loggedInUser()->username }}}'s {{ trans('users.profile') }}</a></li>

                    <li><a href="{{ action('SessionController@logOut') }}"><i class="glyphicon-remove-circle"></i>{{ trans('main.logout-menu') }}</a></li>
                    @endif

                    <!--  Nav Logged In Admin / Super User  -->
                    @if(Helpers::hasAccess('super'))
                    <li><a href="{{ url('dashboard') }}">{{ trans('main.dashboard') }}</a></li>
                    @endif

                </ul>
            </div>
            <!--  End Computer Navigation  -->

            <!--  Start Phone/Tablet Navigation  -->
            <form action="#" id="mobile-nav" class="visible-phone">
                <div class="mobile-nav-select">
                    <select onChange="window.open(this.options[this.selectedIndex].value,'_top')">
                        <option value="">Navigate...</option>
                        <option value="{{ route('home') }}">{{ trans('main.home') }}</option>
                        <option value="{{ url(Str::slug(trans('main.series'))) }}">{{ trans('main.series-menu') }}</option>
                        <option value="{{ url(Str::slug(trans('main.movies'))) }}">{{ trans('main.movies-menu') }}</option>
                        <option value="{{ url(Str::slug(trans('main.news'))) }}">{{ trans('main.news-menu') }}</option>
                        <option value="{{ url(Str::slug(trans('main.people'))) }}">{{ trans('main.people-menu') }}</option>
                        @if(Helpers::hasAccess('super'))
                        <option value="{{ url('dashboard') }}">{{ trans('dash.dash') }}</option>
                        <option value="{{ url('dashboard') }}">{{ trans('main.dashboard') }}</option>
                        @endif
                        @if( ! Sentry::check())
                        <option value="{{ url(Str::slug(trans('main.register'))) }}">{{ trans('main.register-menu') }}</option>
                        <option value="{{ url(Str::slug(trans('main.login'))) }}">{{ trans('main.login-menu') }}</option>
                        @else
                        <option value="{{ Helpers::profileUrl() }}">{{{ Helpers::loggedInUser()->first_name ? Helpers::loggedInUser()->first_name : Helpers::loggedInUser()->username }}}'s {{ trans('users.profile') }}</option>
                        <option value="{{ action('SessionController@logOut') }}">{{ trans('main.logout-menu') }}</option>
                        @endif
                    </select>
                </div>
            </form>
            <!--  End Phone/Tablet Navigation  -->
        </div>
        <!--  End Menu  -->
    </div><!--End Header-->
