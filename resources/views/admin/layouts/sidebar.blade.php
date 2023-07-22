 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a @if(session()->get('page')=='dashboard') style='background-color:blue Important;color:#fff Important;' @endif class="nav-link " href="{{url('admin/dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @if (Auth::guard('admin')->user()->type == 'vendor')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>Vendor Details</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
          <li>
            <a href="{{url('admin/update-vendor-detail/personel')}}">
              <i class="bi bi-circle"></i><span>Personel Details</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/update-vendor-detail/business')}}">
              <i class="bi bi-circle"></i><span>Business Details</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/update-vendor-detail/bank')}}">
              <i class="bi bi-circle"></i><span>Bank Details</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#form-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-user"></i><span>Catelogue Managment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="form-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">   
         <li>
            <a href="{{url('admin/products')}}">
              <i class="bx  bx-fast-forward"></i><span>Products</span>
            </a>
          </li>
          {{-- <li>
            <a href="{{url('admin/filter')}}">
              <i class="bx  bx-fast-forward"></i><span>Product Filter</span>
            </a>
          </li> --}}
          
        </ul>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         
          <li>
            <a href="{{url('admin/update-admin-detail')}}">
              <i class="bi bi-circle"></i><span>Profile</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-user"></i><span>Admin Managment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('admin/admins')}}">
              <i class="bx  bx-fast-forward"></i><span>All</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/admins/admin')}}">
              <i class="bx  bx-fast-forward"></i><span>Admin</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/admins/subadmin')}}">
              <i class="bx  bx-fast-forward"></i><span>Sub Admins</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/admins/vendor')}}">
              <i class="bx  bx-fast-forward"></i><span>Vendor</span>
            </a>
          </li>          
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#form-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-user"></i><span>Catelogue Managment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="form-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         
          <li>
            <a href="{{url('admin/sections')}}">
              <i class="bx  bx-fast-forward"></i><span>Sections</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/categories')}}">
              <i class="bx  bx-fast-forward"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/brands')}}">
              <i class="bx  bx-fast-forward"></i><span>Brands</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/products')}}">
              <i class="bx  bx-fast-forward"></i><span>Products</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/filter')}}">
              <i class="bx  bx-fast-forward"></i><span>Product Filter</span>
            </a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#banner-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-user"></i><span>Banner Managment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="banner-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         
          <li>
            <a href="{{url('admin/banner')}}">
              <i class="bx  bx-fast-forward"></i><span>Banner</span>
            </a>
          </li>
                  
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-user"></i><span>User Managment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         
          <li>
            <a href="{{url('admin/users')}}">
              <i class="bx  bx-fast-forward"></i><span>User</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/subcribers')}}">
              <i class="bx  bx-fast-forward"></i><span>Subcribers</span>
            </a>
          </li>
          
        </ul>
      </li>
     
          
      @endif
     <!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->
