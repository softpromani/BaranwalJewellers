<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.customerList') }}">
            <i class="bi bi-people"></i>
          <span>Customers</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.category.index') }}">
            <i class="bi bi-filter"></i>
          <span>Category</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.product.index') }}">
            <i class="bi bi-shop"></i>
          <span>Product</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.banner.index') }}">
            <i class="bi bi-card-image"></i>
          <span>Banner</span>
        </a>
      </li>

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-shop"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
        </ul>
      </li> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.abandonedCart') }}">
            <i class="bi bi-cart4"></i>
          <span>Abandoned Cart</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.orderList') }}">
            <i class="bi bi-cart-check"></i>
          <span>Orders</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.notification.index') }}">
            <i class="bi bi-bell"></i>
          <span>Notification</span>
        </a>
      </li>

    </ul>

  </aside>
