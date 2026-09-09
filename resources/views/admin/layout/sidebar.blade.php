<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

  <!-- Sidebar Brand -->
  <div class="sidebar-brand">
    <a href="#" class="brand-link">
      <img
        src="{{ asset('img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow" />

      <span class="brand-text fw-light">Admin</span>
    </a>
  </div>

  <!-- Sidebar Search -->
  <div class="sidebar-search" role="search">
    <label for="sidebar-search-input" class="visually-hidden">
      Filter menu
    </label>

    <input
      type="search"
      id="sidebar-search-input"
      class="form-control form-control-sm"
      placeholder="Filter menu…"
      autocomplete="off"
      data-lte-toggle="sidebar-search"
      data-lte-target="#navigation" />

    <p
      class="fs-7 text-secondary mt-2 mb-0"
      data-lte-search-empty
      role="status"
      hidden>
      No matching pages.
    </p>
  </div>

  <!-- Sidebar Wrapper -->
  <div class="sidebar-wrapper">

    <nav class="mt-2" aria-label="Main navigation">

      <!-- Sidebar Menu -->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        data-accordion="false"
        id="navigation">

        <!-- Dashboard -->
        <li class="nav-item">

          <a href="{{ route('dashboard') }}" class="nav-link">

            <i class="nav-icon bi bi-speedometer"></i>

            <p>
              Dashboard
            </p>

          </a>

        </li>

        <!-- Admin -->
        <li class="nav-item">

          <a href="{{ route('admins.index') }}" class="nav-link">

            <i class="nav-icon bi bi-people"></i>

            <p>
              Admin
            </p>

          </a>

        </li>

      </ul>

    </nav>

  </div>

</aside>