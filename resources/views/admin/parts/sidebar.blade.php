<div class="vertical-menu">
<!-- LOGO -->
<div class="navbar-brand-box">
    <a href="#" class="logo logo-dark">
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="35">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="30">
        </span>
    </a>

    <a href="#" class="logo logo-light">
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="35">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="20">
        </span>
    </a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
    <i class="fa fa-fw fa-bars"></i>
</button>

<div data-simplebar class="sidebar-menu-scroll">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">

            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="uil-home-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#" class=" waves-effect">
                    <i class="uil-window-section"></i>
                    <span>Hospital Appointments </span>
                </a>

            </li>

            <li>
                <a href="#" class=" waves-effect">
                    <i class="uil-comments-alt"></i>
                    <span>Hotel Appointments </span>
                </a>
            </li>


            <li>
                <a href="{{ route('vet.index') }}" class=" waves-effect">
                    <i class="uil-comments-alt"></i>
                    <span>Manage Vets </span>
                </a>
            </li>

            <li>
                <a href="{{ route('vet.schedule') }}" class=" waves-effect">
                    <i class="uil-comments-alt"></i>
                    <span>Vets Schedule </span>
                </a>
            </li>

            
            <li>
                <a href="{{ route('invoice.index') }}" class=" waves-effect">
                    <i class="uil-comments-alt"></i>
                    <span>Invoice </span>
                </a>
            </li>

            <li>
                <a href="{{ route('cat.index') }}" class=" waves-effect">
                    <i class="uil-comments-alt"></i>
                    <span>Cats </span>
                </a>
            </li>
            <li>
                <a href="{{ route('caretaker.index') }}" class=" waves-effect">
                    <i class="uil-comments-alt"></i>
                    <span>Caretaker </span>
                </a>
            </li>
            <li>
                <a href="{{ route('hrooms.index') }}" class=" waves-effect">
                    <i class="uil-comments-alt"></i>
                    <span>Rooms </span>
                </a>
            </li>
            

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>