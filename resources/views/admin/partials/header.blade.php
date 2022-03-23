<header id="page-topbar" class="bg-white card ">
    <div class="navbar-header ">
        <div class="d-flex justify-content-between align-items-center">
           <div class="ms-4">
               @yield('name_page')
           </div>
           
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                    <img style="width:50px; height:50px" class="rounded-circle header-profile-user" src="{{ URL::asset('backend/images/default-avatar/avatar.png') }}" alt="Header Avatar"> 
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Duc Anh</span> 
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i> 
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        <i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> 
                        <span class="align-middle">View Profile</span>
                    </a> 
                    <a class="dropdown-item" href="#">
                        <i class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> 
                        <span class="align-middle">My Wallet</span>
                    </a> 
                    {{-- <a class="dropdown-item d-block" href="#">
                        <i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> 
                        <span class="align-middle">Settings</span> 
                        <span class="badge bg-soft-success rounded-pill mt-1 ms-2 text-dark">03</span>
                    </a>  --}}
                    {{-- <a class="dropdown-item" href="#">
                        <i class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i> 
                        <span class="align-middle">Lock screen</span>
                    </a>  --}}
                    <a class="dropdown-item" href="#">
                        <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> 
                        <span class="align-middle">Sign out</span>
                    </a> 
                </div>
            </div>
           
        </div>
    </div>
</header>

{{-- <script src="{{URL::asset('backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('backend/js/getCurrentTime.js')}}"></script> --}}