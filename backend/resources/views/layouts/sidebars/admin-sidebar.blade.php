<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        
        <li
            class="sidebar-item {{ Route::currentRouteName() === 'admin.home' ? 'active' : '' }}">
            <a href="{{ route ('admin.home')}}" class='sidebar-link'>
                <i class="fa-solid fa-newspaper"></i>
                <span>Blog</span>
            </a>
        </li>

        <li
            class="sidebar-item {{ Route::currentRouteName() === 'admin.statistik' ? 'active' : '' }}">
            <a href="{{ route ('admin.statistik')}}" class='sidebar-link'>
                <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Statistik Penjualan</span>
            </a>
        </li>

        <li
            class="sidebar-item {{ Route::currentRouteName() === 'admin.list-kreator' ? 'active' : '' }}">
            <a href="{{ route ('admin.list-kreator')}}" class='sidebar-link'>
                <i class="fa-solid fa-user-group"></i>
                <span>Kreators</span>
            </a>
        </li>

        <li
            class="sidebar-item {{ Route::currentRouteName() === 'admin.kelola-komentar' ? 'active' : '' }}">
            <a href="{{ route ('admin.kelola-komentar')}}" class='sidebar-link'>
                <i class="fa-solid fa-message"></i>
                <span>Komentar</span>
            </a>
        </li>
    </ul>
</div>