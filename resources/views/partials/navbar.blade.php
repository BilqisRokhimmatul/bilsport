<header style="background: #FDF5E6; padding: 15px 5%; box-shadow: 0 4px 15px rgba(0,0,0,0.05); position: fixed; width: 100%; top: 0; z-index: 1000;">
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto;">
        
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="BILSPORT" style="height: 50px;">
            </a>
        </div>

        <div style="flex: 1; margin: 0 50px;">
            <form style="display: flex; background: white; border-radius: 30px; overflow: hidden; border: 1px solid #ddd;">
                <input type="text" placeholder="Cari lapangan kesukaanmu..." style="flex: 1; border: none; padding: 12px 20px; outline: none;">
                <button type="submit" style="background: maroon; color: white; border: none; padding: 0 25px; cursor: pointer;">Cari</button>
            </form>
        </div>

        <nav style="display: flex; gap: 25px; align-items: center;">
            <a href="{{ url('/dashboard') }}" style="text-decoration: none; color: #333; font-weight: 600;">Dashboard</a>
            <a href="{{ url('/lapangan') }}" style="text-decoration: none; color: #333; font-weight: 600;">Lapangan</a>
            <a href="{{ url('/contact') }}" style="text-decoration: none; color: #333; font-weight: 600;">Contact</a>
            <a href="{{ url('/about') }}" style="text-decoration: none; color: #333; font-weight: 600;">About</a>
            
            @auth
            <div style="display: flex; align-items: center; gap: 15px; border-left: 2px solid #ddd; padding-left: 20px; margin-left: 10px;">
                <a href="{{ route('profile.edit') }}" style="text-decoration: none; color: maroon; font-weight: bold;">
                    👤 {{ Auth::user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #ef4444; font-weight: bold; cursor: pointer; padding: 0;">
                        Keluar
                    </button>
                </form>
            </div>
            @endauth
        </nav>
    </div>
</header>