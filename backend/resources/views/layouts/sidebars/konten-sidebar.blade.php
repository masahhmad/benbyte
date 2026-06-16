<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Kelas</li>

        @forelse ($kelas as $item)
            <li class="sidebar-item active row">
                <div class="sidebar-link">
                    <a href="{{('kreator.list-kelas')}}" class="w-100 d-flex justify-content-start">
                        <span>{{$item->nama_kelas}}</span>
                    </a>

                    @if (Auth::user()->role === 'kreator')
                        <a href="#" id="editLabel" class="d-flex justify-content-end mx-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="{{route('kreator.delete-kelas', $item->id)}}" class="d-flex justify-content-end">
                            <i class="fa-solid fa-delete-left"></i>
                        </a>
                    @endif
                    
                </div>
            </li>
        @empty
            <li class="sidebar-item active row">
                <div class="sidebar-link">
                    <span>Belum Ada Kelas</span>
                </div>
            </li>
        @endforelse
        
        @if (Auth::user()->role === 'kreator')
            <li class="sidebar-title row">
                <div class="sidebar-link">
                    <form method="POST" action="{{ route ('kreator.create-kelas')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" name="kelas_id" id="kelas_id" value="{{$kelas->id}}">
                                    <input type="text" id="label" class="form-control" placeholder="Tambah Label" name="label">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        @endif
    </ul>
</div>