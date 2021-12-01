<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Noble<span>UI</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div class="sidebar-body">
    <ul class="nav">

      <li class="nav-item nav-category">Home</li>
      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{ url('/') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item nav-category">Jedinke</li>

      <li class="nav-item {{ active_class(['sz_animal_type/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#sz-tables" role="button" aria-expanded="{{ is_active_route(['/sz_animal_type/*']) }}" aria-controls="sz-tables">
          <i class="link-icon" data-feather="layout"></i>
          <span class="link-title">Strogo zaštićene</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="sz-tables">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/sz_animal_type?type=1') }}" class="nav-link">Sisavci</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/sz_animal_type?type=2') }}" class="nav-link">Ptice</a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/sz_animal_type?type=3') }}" class="nav-link">Gmazovi</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/sz_animal_type?type=4') }}" class="nav-link">Vodozemci</a>
            </li>
          </ul>
        </div>  
      </li>

      
      <li class="nav-item {{ active_class(['ij_animal_type']) }}">
        <a href="{{ url('/ij_animal_type') }}" class="nav-link">
          <i class="link-icon" data-feather="alert-circle"></i>
          <span class="link-title">Invazivne vrste</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['zj_animal_type']) }}">
        <a class="nav-link"  href="{{ url('/zj_animal_type') }}" role="button">
          <i class="link-icon" data-feather="key"></i>
          <span class="link-title">Zapljenjene vrste</span>
        </a>
      </li>

      <li class="nav-item nav-category">Podaci</li>
      <li class="nav-item {{ active_class(['animal_import']) }}">
        <a class="nav-link"  href="{{ url('/animal_import') }}" role="button">
          <i class="link-icon" data-feather="upload-cloud"></i>
          <span class="link-title">Import životinja</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['animal_order']) }}">
        <a class="nav-link"  href="{{ url('/animal_order') }}" role="button">
          <i class="link-icon" data-feather="link"></i>
          <span class="link-title">Redovi životinja</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['animal_category']) }}">
        <a class="nav-link"  href="{{ url('/animal_category') }}" role="button">
          <i class="link-icon" data-feather="link"></i>
          <span class="link-title">Porodice životinja</span>
        </a>
      </li>

      <li class="nav-item nav-category">Cjenik</li>
      <li class="nav-item {{ active_class(['animal_size']) }}">
        <a class="nav-link"  href="{{ url('/animal_size') }}" role="button">
          <i class="link-icon" data-feather="bar-chart-2"></i>
          <span class="link-title">Veličine jedinki</span>
        </a>
      </li>

      <li class="nav-item nav-category">Ustanove</li>
      <li class="nav-item {{ active_class(['shelter/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#shelter-tables" role="button" aria-expanded="{{ is_active_route(['/shelter/*']) }}" aria-controls="shelter-tables">
          <i class="link-icon" data-feather="layout"></i>
          <span class="link-title">Oporavilišta</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="shelter-tables">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/shelter') }}" class="nav-link">Popis svih</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/user') }}" class="nav-link">Korisnici oporavilišta</a>
            </li>

            <li class="nav-item">
              <a href="{{ route('shelters.founders.index', auth()->user()->shelter->id) }}" class="nav-link">Nalaznici</a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/shelter_staff') }}" class="nav-link">Osoblje oporavilišta</a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/shelter/create') }}" class="nav-link">Dodaj novo</a>
            </li>
          
          </ul>
        </div>  
      </li>

      <li class="nav-item nav-category">CRUD</li>
      <li class="nav-item {{ active_class(['user']) }}">
        <a class="nav-link" data-toggle="collapse" href="#users" role="button">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Korisnici</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="users">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/user') }}" class="nav-link }}">Lista</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/roleMapping') }}" class="nav-link }}">Role</a>
            </li>
          </ul>
        </div>  
      </li>

      <li class="nav-item nav-category">Docs</li>
      <li class="nav-item">
        <a href="https://www.nobleui.com/laravel/documentation/docs.html" target="_blank" class="nav-link">
          <i class="link-icon" data-feather="hash"></i>
          <span class="link-title">Documentation</span>
        </a>
      </li>

      

    </ul>
  </div>
</nav>