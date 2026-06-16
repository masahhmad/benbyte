<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        
        <li
            class="sidebar-item {{ Route::currentRouteName() === 'kreator.home' ? 'active' : '' }}">
            <a href="{{ route('kreator.home') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li
            class="sidebar-item {{ Route::currentRouteName() === 'kreator.create-kelas' ? 'active' : '' }}">
            <a href="{{ route ('kreator.create-kelas')}}" class='sidebar-link'>
                <i class="fa-solid fa-square-plus"></i>
                <span>Buat Kelas</span>
            </a>
        </li>

        <li
            class="sidebar-item {{ Route::currentRouteName() === 'kreator.grafik-pembelian' ? 'active' : '' }}">
            <a href="{{ route ('kreator.grafik-pembelian')}}" class='sidebar-link'>
                <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Grafik Pembelian</span>
            </a>
        </li>
        
    </ul>
</div>