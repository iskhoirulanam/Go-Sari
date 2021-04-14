<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="nav-item dropdown {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a href="{{ url('admin/dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>
      <li class="menu-header">Pages</li>
      <li
        class="nav-item dropdown {{ request()->is('admin/members') || request()->is('admin/invoices') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Member</span></a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('admin/members') }}">Akun</a></li>
          <li><a href="{{ url('admin/invoices') }}">Invoice</a></li>
        </ul>
      </li>
      <li
        class="nav-item dropdown {{ request()->is('admin/garbage-categories') || request()->is('admin/hamlets') ? 'active' : '' }}"">
        <a href=" #" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Kelola Data</span></a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('admin/garbage-categories') }}">Kategori Sampah</a></li>
          <li><a href="{{ url('admin/hamlets') }}">Dusun</a></li>
        </ul>
      </li>
    </ul>

    {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Documentation
      </a>
    </div> --}}
  </aside>
</div>
