<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
            <a class="link-secondary" href="/">Главная</a>
        </div>
        <div class="col-4 text-center">
            <h3><a class="blog-header-logo text-dark" href="{{ url('/') }}">{{ config('app.name') }}</a></h3>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            <a class="link-secondary" href="#" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
            </a>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                                <a class="btn-sm btn-outline-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                        @if (Route::has('register'))

                                <a class="btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>

                        @endif
                    @else
                            <a id="navbarDropdown" class="btn-sm btn-outline-secondary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                    <a class="btn-sm btn-outline-secondary" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    @endguest


    </div>
</header>
