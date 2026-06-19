<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                    ImmobSite
                </a>
            </div>

            <!-- Main Navigation -->
            <div class="hidden md:flex space-x-8">
                <a href="{{route('home')}}" class="text-gray-700 hover:text-blue-600 transition">Buy</a>
                <a href="{{route('home')}}?type=rent" class="text-gray-700 hover:text-blue-600 transition">Rent</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition">Sell</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition">Agents</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition">News</a>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('client.favorites') }}" class="text-gray-700 hover:text-blue-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </a>
                    <a href="{{ auth()->user()->role === 'bailleur' ? route('bailleur.dashboard') : route('client.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-600 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Sign In</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
