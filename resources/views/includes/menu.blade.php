 <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu" >
            <a class="pure-menu-heading" href="#">GIS</a>

            <ul class="pure-menu-list">
                <li class="pure-menu-item"><a href="{{route('admin.home')}}" class="pure-menu-link">Home</a></li>
                <li class="pure-menu-item"><a href="{{route('admin.upload_file')}}" class="pure-menu-link">Upload File</a></li>
                <li class="pure-menu-item"><a href="{{route('admin.analisis_data')}}" class="pure-menu-link">Analisis Data Kecamatan</a></li>
                <li class="pure-menu-item"><a href="{{route('admin.analisis_data_arho')}}" class="pure-menu-link">Analisis Data Arho</a></li>
                
            </ul>
        </div>


    </div>

@push('scripts')

@endpush

