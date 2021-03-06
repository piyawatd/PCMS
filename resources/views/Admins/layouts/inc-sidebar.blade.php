<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  {{--<li class="nav-item @if ($navsel===--}}
                {{--'dashboard') active @endif">--}}
    {{--<a class="nav-link" href="{{ route('adminindex') }}">--}}
      {{--<i class="fas fa-fw fa-tachometer-alt"></i>--}}
      {{--<span>Dashboard</span></a>--}}
  {{--</li>--}}
    <li class="nav-item @if ($navsel===
                'content') active @endif">
        <a class="nav-link" href="{{ route('admincontent') }}">
            <i class="far fa-file-alt"></i>
            <span>บทความ</span></a>
    </li>
    <li class="nav-item @if ($navsel===
                'product') active @endif">
        <a class="nav-link" href="{{ route('adminproduct') }}">
            <i class="fab fa-product-hunt"></i>
            <span>สินค้า</span></a>
    </li>
    <li class="nav-item @if ($navsel===
                'order') active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
            <i class="fas fa-fw fa-cog"></i>
            <span>Order</span>
        </a>
        <div id="collapseOrder" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('adminorder')}}">Order</a>
                <a class="collapse-item" href="cards.html">Slip</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if ($navsel===
                'admincustomer') active @endif">
        <a class="nav-link" href="{{ route('admincustomer') }}">
            <i class="fas fa-user fa-tachometer-alt"></i>
            <span>Customer</span></a>
    </li>

    <li class="nav-item @if (($navsel===
                'categorycontent') || ($navsel===
                'category')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-layer-group"></i>
            <span>Category</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admincategorycontent') }}">Content</a>
                <a class="collapse-item" href="{{ route('admincategory') }}">Product</a>
            </div>
        </div>
    </li>


    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" href="{{ route('adminindex') }}">--}}
            {{--<i class="fas fa-tags"></i>--}}
            {{--<span>Coupon</span></a>--}}
    {{--</li>--}}
    <li class="nav-item">
        <a class="nav-link" target="_blank" href="{{ route('filemanager') }}">
            <i class="fas fa-folder-open"></i>
            <span>Asset Manager</span></a>
    </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    System
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('userindex') }}">
            <i class="fas fa-user-lock"></i>
            <span>User</span></a>
    </li>
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" href="{{ route('adminindex') }}">--}}
            {{--<i class="fas fa-user-lock"></i>--}}
            {{--<span>SEO</span></a>--}}
    {{--</li>--}}

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
