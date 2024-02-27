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
                <a href="{{ route('hospital-appointments') }}" class=" waves-effect">
                    <i class="uil-hospital"></i>
                    <span>Hospital Schedule </span>
                </a>

            </li>

            <li class="{{ Helper::areActiveRoutes(['manage-hospital-appointments','get-hospital-invoice']) }}">
                <a href="{{ route('manage-hospital-appointments') }}" class=" waves-effect">
                    <i class="uil-hospital"></i>
                    <span>Hospital Appointments </span>
                </a>

            </li>

            <li>
                <a href="{{ route('hotel-appointments') }}" class=" waves-effect">
                    <i class="uil-building"></i>
                    <span>Hotel Schedule </span>
                </a>
            </li>

            <li class="{{ Helper::areActiveRoutes(['manage-hotel-bookings','get-hotel-invoice']) }}">
                <a href="{{ route('manage-hotel-bookings') }}" class=" waves-effect">
                    <i class="uil-building"></i>
                    <span>Hotel Bookings </span>
                </a>

            </li>

            <li class="{{ Helper::areActiveRoutes(['invoice.index','invoice.view','invoice.edit','invoice.create']) }}">
                <a href="{{ route('invoice.index') }}" class=" waves-effect">
                    <i class="uil-invoice"></i>
                    <span>Custom Invoices </span>
                </a>
            </li>

            @if (Auth::user()->user_type == 'admin')
                <li class="{{ Helper::areActiveRoutes(['vet.index','vet.view','vet.edit','vet.create']) }}">
                    <a href="{{ route('vet.index') }}" class=" waves-effect">
                        <i class="uil-user"></i>
                        <span>Manage Vets </span>
                    </a>
                </li>

                <li class="{{ Helper::areActiveRoutes(['vet.schedule']) }}">
                    <a href="{{ route('vet.schedule') }}" class=" waves-effect">
                        <i class="uil-calendar-alt"></i>
                        <span>Vets Work Schedule </span>
                    </a>
                </li>
            @endif
            
            <li class="{{ Helper::areActiveRoutes(['caretaker.index','caretaker.view','caretaker.edit','caretaker.create','caretaker.blacklisted']) }}">
                <a href="{{ route('caretaker.index') }}" class=" waves-effect">
                    <i class="uil-users-alt"></i>
                    <span>Caretakers </span>
                </a>
            </li>

            <li class="{{ Helper::areActiveRoutes(['cat.index','cat.create','cat.view','cat.edit']) }}">
                <a href="{{ route('cat.index') }}" class="waves-effect">
                    <i class="uil-github-alt"></i>
                    <span>Cats </span>
                </a>
            </li>
            
            <li class="{{ Helper::areActiveRoutes(['hrooms.index','hrooms.create','hrooms.view','hrooms.edit']) }}">
                <a href="{{ route('hrooms.index') }}" class=" waves-effect">
                    <i class="uil-building"></i>
                    <span>Rooms </span>
                </a>
            </li>
            <li class="{{ Helper::areActiveRoutes(['procedure.index','procedure.create','procedure.view','procedure.edit']) }}">
                <a href="{{ route('procedure.index') }}" class=" waves-effect">
                    <i class="uil-medical-square"></i>
                    <span>Procedures </span>
                </a>
            </li>

            
            <li class="{{ Helper::areActiveRoutes(['forms.index','form.create','form.view','form.edit','custom-forms','custom-form.create','custom-form.view','custom-form.edit']) }}">
                <a href="#" class="has-arrow waves-effect">
                    <i class="uil-file"></i> <span>Forms</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li class="{{ Helper::areActiveRoutes(['forms.index','form.create','form.view','form.edit']) }}"><a href="{{ route('forms.index') }}">Create Forms</a></li>
                    <li class="{{ Helper::areActiveRoutes(['custom-forms','custom-form.create','custom-form.view','custom-form.edit']) }}"><a href="{{ route('custom-forms') }}">Customer Forms </a></li>
                </ul>
            </li>
            @if (Auth::user()->user_type == 'admin')
                <li class="{{ Helper::areActiveRoutes(['users.index','user.create','user.view','user.edit']) }}">
                    <a href="{{ route('users') }}" class=" waves-effect">
                        <i class="uil-user"></i>
                        <span>User Management </span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>