<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">

        {{-- <img src="{{'templates/dist/img/AdminLTELogo.png'}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">UrPay</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                            <a href="{{ url('warga_penduduk') }}" class="nav-link {{ request()->is('warga_penduduk*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-group"></i>
                                <p>Penduduk</p>
                            </a>
                </li>
                <li class="nav-item">
                            <a href="{{ url('tagihan') }}" class="nav-link {{ request()->is('tagihan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>Tagihan</p>
                            </a>
                </li>
                <li class="nav-item">
                            <a href="{{ url('user') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-user"></i>
                                <p>User</p>
                            </a>
                </li>

                <hr style="border-top: 1px solid #6c757d; margin: 0.5rem;" />


                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                            <a href="{{ url('transaksi') }}" class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Transaksi Tagihan</p>
                            </a>
                </li>

                <hr style="border-top: 1px solid #6c757d; margin: 0.5rem;" />

                <li class="nav-header">LAPORAN</li>
                <li class="nav-item">
                            <a href="../index2.html" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Tagihan Bulanan</p>
                            </a>
                </li>
                <li class="nav-item">
                            <a href="../index2.html" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Tagihan Tunggakan</p>
                            </a>
                </li>

                <hr style="border-top: 1px solid #6c757d; margin: 0.5rem;" />


                <li class="nav-item">
                <a  class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
