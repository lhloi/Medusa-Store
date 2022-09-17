<div class="col-md-3">

    <!-- Profile Image -->
    <div class="card-primary">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                    src="{{ asset('storage/images/users/underfile-icon-user.jpg') }}" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center mb-3">{{ Auth::user()->profile->first()->name }}</h3>

            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" style="text-color:black;" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Sản Phẩm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                              <li class="nav-item ml-3 pl-3">
                                  <a href="{{ Url('user/profile') }}" class="nav-link">
                                      {{-- <i class="far fa-circle nav-icon"></i> --}}
                                      <p>Hồ Sơ</p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3 pl-3">
                                  <a href="{{ Url('user/address') }}" class="nav-link">
                                      {{-- <i class="far fa-circle nav-icon"></i> --}}
                                      <p>Địa Chỉ</p>
                                  </a>
                              </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Url('user/purchase') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Đơn Hàng</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
