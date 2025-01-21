<x-layouts.app :title="$title ?? ''">
    @section('content')
        <div class="container" id="container">
            @yield('container')
        </div>
    @endsection
</x-layouts.app>