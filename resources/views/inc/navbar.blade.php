@if (Route::has('login'))
    @auth
        @if(Request::is('/'))
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button>Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
        @endif
    @endauth
@endif
