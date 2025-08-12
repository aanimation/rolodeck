@auth()
    @if (in_array(request()->route()->getName(),['sign-in', 'login'],))
        @include('layouts.dashboard.navbars.guest.login')
        {{ $slot }}
        @include('layouts.dashboard.footers.guest.description')
    @elseif (in_array(request()->route()->getName(),['profile', 'my-profile'],))
        @include('layouts.dashboard.navbars.auth.sidebar')
        <div class="main-content position-relative bg-gray-100">
            @include('layouts.dashboard.navbars.auth.nav-profile')
            <div>
                {{ $slot }}
                @include('layouts.dashboard.footers.auth.footer')
            </div>
        </div>
    @else
        @include('layouts.dashboard.navbars.auth.sidebar')
        @include('layouts.dashboard.navbars.auth.nav')
        {{ $slot }}
        <main>
            <div class="container-fluid">
                <div class="row">
                    @include('layouts.dashboard.footers.auth.footer')
                </div>
            </div>
        </main>
    @endif
@endauth

@guest
    @if (!auth()->check() && in_array(request()->route()->getName(),['login'],))
        @include('layouts.dashboard.navbars.guest.login')
        {{ $slot }}
        <div class="mt-5">
            @include('layouts.dashboard.footers.guest.with-socials')
        </div>

    @elseif (!auth()->check() && in_array(request()->route()->getName(),['sign-up'],))
        <div>
            @include('layouts.dashboard.navbars.guest.sign-up')
            {{ $slot }}
            @include('layouts.dashboard.footers.guest.with-socials')
        </div>
    @endif
@endguest
