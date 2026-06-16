<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        
        <li
            class="sidebar-item {{ Route::currentRouteName() === 'user.home' ? 'active' : '' }}">
            <a href="{{ route('user.home') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li
            class="sidebar-item {{ Route::currentRouteName() === 'user.kelasku' ? 'active' : '' }}">
            <a href="{{ route('user.kelasku') }}" class='sidebar-link'>
                <i class="fa-solid fa-swatchbook"></i>
                <span>Kelasku</span>
            </a>
        </li>

        <li class="sidebar-item  has-sub {{ Route::currentRouteName() === 'user.programming-kelas' || Route::currentRouteName() === 'user.uiux-kelas' || Route::currentRouteName() === 'user.network-kelas' ? 'active' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-cart-flatbed"></i>
                <span>Toko Kelas</span>
            </a>
            
            <ul class="submenu submenu-closed" style="--submenu-height: 215px;">
                
                <li class="submenu-item {{ Route::currentRouteName() === 'user.programming-kelas' ? 'active' : '' }}">
                    <a href="{{ route('user.programming-kelas') }}" class="submenu-link">Programming</a>
                    
                </li>
                
                <li class="submenu-item {{ Route::currentRouteName() === 'user.uiux-kelas' ? 'active' : '' }}">
                    <a href="{{ route('user.uiux-kelas') }}" class="submenu-link">UI/UX Design</a>
                    
                </li>
                
                <li class="submenu-item {{ Route::currentRouteName() === 'user.network-kelas' ? 'active' : '' }}">
                    <a href="{{ route('user.network-kelas') }}" class="submenu-link">Network Engineering</a>
                    
                </li>
                
            </ul>
            
        
        </li>
        
    </ul>
</div>