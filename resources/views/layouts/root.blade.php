@php
    $dashboardRoutes = [
        'manage*',
    ];
@endphp

@if(request()->is($dashboardRoutes))
    <x-layouts.dashboard.base>
        <x-layouts.dashboard.app>
            {{ $slot }}
        </x-layouts.dashboard.app>
    </x-layouts.dashboard.base>
@else
    <x-layouts.market.base>
        {{ $slot }}
    </x-layouts.market.base>
@endif