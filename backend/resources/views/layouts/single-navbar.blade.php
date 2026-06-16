<header>
    <nav class="page-heading navbar-light mt-4">
        <div class="container d-block">
            @if (Route::currentRouteName() === Auth::user()->role . '.blog')
                <a href="{{route(Auth::user()->role . '.home')}}"><i class="bi bi-chevron-left"></i></a>
                <a class="navbar-brand ms-4 fs-3 fw-bold" href="{{route(Auth::user()->role . '.home')}}">Blogs</a>
            @elseif(Route::currentRouteName() === 'kreator.konten-kelas')
                <a href="{{route('kreator.create-kelas')}}"><i class="bi bi-chevron-left"></i></a>
                <a class="navbar-brand ms-4 fs-3 fw-bold" href="{{route('kreator.create-kelas')}}">Kembali Ke Buat Kelas</a>
            @elseif(Route::currentRouteName() === 'admin.detail-kelas-kreator')
                <a href="{{route('admin.list-kreator')}}"><i class="bi bi-chevron-left"></i></a>
            @elseif(Route::currentRouteName() === 'user.beli-kelas' || Route::currentRouteName() === 'user.lanjut-beli')
                <a href="{{ url()->previous() }}"><i class="bi bi-chevron-left"></i></a>
                <a class="navbar-brand ms-4 fs-3 fw-bold" href="{{ url()->previous() }}">Kembali</a>
            @endif
        </div>
    </nav>
</header>