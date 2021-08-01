<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link text-center">
      <!-- <img src="{{ asset('assets/admins/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-bold-light">E-Voting ROHIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/admins/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}" class="nav-link {{ set_active('dashboard') }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pemilih.index') }}" class="nav-link {{ set_active(['pemilih.index', 'pemilih.create']) }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Pemilih
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kandidat.index') }}" class="nav-link {{ set_active(['kandidat.index', 'kandidat.create']) }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Kandidat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kelas.index') }}" class="nav-link {{ set_active(['kelas.index', 'kelas.create']) }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Kelas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('siswa.index') }}" class="nav-link {{ set_active(['siswa.index', 'siswa.create']) }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Siswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('periode.index') }}" class="nav-link {{ set_active(['periode.index', 'periode.create']) }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Periode
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('waktu-voting.index') }}" class="nav-link {{ set_active(['waktu-voting.index', 'waktu-voting.create']) }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Waktu Voting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('quick-count.index') }}" class="nav-link {{ set_active('quick-count.index') }">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Quick Count
              </p>
            </a>
          </li>
          <li class="nav-header">Menu Lainnya</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-clipboard"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Edit Profile
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  @include('admins.layouts.footer')