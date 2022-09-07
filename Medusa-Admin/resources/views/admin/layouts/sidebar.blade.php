  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('/storage/images/logo/logo.jpg') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Admin Medusa</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('/storage/images/users/underfile-icon-user.jpg') }}" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ Auth::user()->name }}</a>
              </div>
              <div class="d-flex justify-content-end align-items-center">
                  <a href="{{ URL::to('/admin/logout') }}">Logout</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">

                  {{-- <li class="nav-item">
                      <a href="{{ Url('admin/category') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Danh muc
                              {{-- <span class="right badge badge-danger">New</span> --}}
                          </p>
                      </a>
                  </li> --}}
                  <li class="nav-item">
                      <a href="{{ Url('admin/menu') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>Menus</p>
                      </a>
                  </li>
                  {{-- <li class="nav-item">
                        <a href="{{Url('admin/product') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Sản Phẩm</p>
                        </a>
                    </li> --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Sản Phẩm
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('admin/product') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách sản phẩm</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('admin/category') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh mục</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('admin/brand') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thương Hiệu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('admin/product/product-color') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Màu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('admin/product/product-size') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Size</p>
                                </a>
                            </li>

                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ Url('admin/slider') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>Slider</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ Url('admin/user') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>nhân viên</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ Url('admin/role') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>Vai Trò</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ Url('admin/permission/add-permission') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>Tạo Permissions</p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
