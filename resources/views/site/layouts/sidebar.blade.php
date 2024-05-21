@php
    use Illuminate\Support\Facades\Auth;
    use App\Enums\UserTypeEnum;
    $user = Auth::user();
@endphp

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion custom-font-size" id="accordionSidebar">
    <a style="background-color: white" class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img width="100%" src="/images/navbar-logo.webp">
        </div>
        {{-- <div class="sidebar-brand-text mx-3 text-dark">Bakunako</div> --}}
    </a>
    <hr class="sidebar-divider my-0">
    @if ($user->user_type_id == UserTypeEnum::ADMINISTRATOR)
        <!-- Show all navigation options for administrator -->
        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="/admin/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span style="{{ Request::is('admin/dashboard*') ? 'color: #CD9F8E' : '' }}">Dashboard</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('admin/vaccination*') ? 'active' : '' }}">
            <a class="nav-link" href="/admin/vaccination">
                <i class="fas fa-syringe fa-fw"></i>
                <span style="{{ Request::is('admin/vaccination*') ? 'color: #CD9F8E' : '' }}">Vaccine Infants</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('admin/feedbacks*') ? 'active' : '' }}">
            <a class="nav-link" href="/admin/feedbacks">
                <i class="fas fa-bullhorn fa-fw"></i>
                <span style="{{ Request::is('admin/feedbacks*') ? 'color: #CD9F8E' : '' }}">Feedbacks</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('admin/adduser*') ? 'active' : '' }}">
            <a class="nav-link" href="/admin/adduser">
                <i class="fas fa-plus fa-fw"></i>
                <span style="{{ Request::is('admin/adduser*') ? 'color: #CD9F8E' : '' }}">Create an Account</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('admin/voucher*') ? 'active' : '' }}">
            <a class="nav-link" href="/admin/voucher">
                <i class="fas fa-money-bill fa-fw"></i>
                <span style="{{ Request::is('admin/voucher*') ? 'color: #CD9F8E' : '' }}">Manage Voucher</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('admin/partners*') ? 'active' : '' }}">
            <a class="nav-link" href="/admin/partners">
                <i class="fas fa-handshake fa-fw"></i>
                <span style="{{ Request::is('admin/partners*') ? 'color: #CD9F8E' : '' }}">Manage Partners</span></a>
        </li>
    @elseif ($user->user_type_id == UserTypeEnum::PARENT)
        <!-- Show specific navigation options for parent -->
        <li class="nav-item {{ (Request::is('parent/dashboard*') ? 'active' : '') }}">
            <a class="nav-link" href="/parent/dashboard">
                <i class="fas fa-syringe fa-fw"></i>
                <span style="{{ Request::is('parent/dashboard*') || Request::is('parent/infant*') ? 'color: #CD9F8E;' : '' }}">Infant Vaccination</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('parent/vaccines*') ? 'active' : '' }}">
            <a class="nav-link" href="/parent/vaccines">
                <i class="fas fa-file-invoice fa-fw"></i>
                <span style="{{ Request::is('parent/vaccines*') ? 'color: #CD9F8E;' : '' }}">Vaccine Description and Information</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('parent/recommendedvaccinesandschedules*') ? 'active' : '' }}">
            <a class="nav-link" href="/parent/recommendedvaccinesandschedules">
                <i class="fas fa-clock fa-fw"></i>
                <span style="{{ Request::is('parent/recommendedvaccinesandschedules*') ? 'color: #CD9F8E;' : '' }}">Recommended Vaccine Schedules</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('parent/feedback*') ? 'active' : '' }}">
            <a class="nav-link" href="/parent/feedback">
                <i class="fas fa-bullhorn fa-fw"></i>
                <span style="{{ Request::is('parent/feedback*') ? 'color: #CD9F8E;' : '' }}">Submit Feedback</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('parent/voucher*') ? 'active' : '' }}">
            <a class="nav-link" href="/parent/voucher/rewards">
                <i class="fas fa-money-bill fa-fw"></i>
                <span style="{{ Request::is('parent/voucher*') ? 'color: #CD9F8E;' : '' }}">Voucher</span></a>
        </li>
    @elseif ($user->user_type_id == UserTypeEnum::HEALTHCARE_PROVIDER)
        <!-- Show specific navigation options for healthcare provider -->
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('healthcare_provider/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="/healthcare_provider/dashboard">
                <i class="fas fa-syringe fa-fw"></i>
                <span style="{{ Request::is('healthcare_provider/dashboard*') ? 'color: #CD9F8E;' : '' }}">Vaccine Infants</span></a>
        </li>
        <!-- Add active class to the li if the current route matches -->
        <li class="nav-item {{ Request::is('healthcare_provider/feedback*') ? 'active' : '' }}">
            <a class="nav-link" href="/healthcare_provider/feedback">
                <i class="fas fa-bullhorn fa-fw"></i>
                <span style="{{ Request::is('healthcare_provider/feedback*') ? 'color: #CD9F8E;' : '' }}">Submit Feedback</span></a>
        </li>
    @endif
</ul>
<!-- Sidebar -->
