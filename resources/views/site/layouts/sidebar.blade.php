@php
    use Illuminate\Support\Facades\Auth;
    use App\Enums\UserTypeEnum;
    $user = Auth::user();
@endphp

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion custom-font-size" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img width="100%" src="/images/favicon.png">
        </div>
        <div class="sidebar-brand-text mx-3">Bakunako</div>
    </a>
    <hr class="sidebar-divider my-0">
    @if ($user->user_type_id == UserTypeEnum::ADMINISTRATOR)
        <!-- Show all navigation options for administrator -->
        <li class="nav-item active">
            <a class="nav-link" href="/admin/dashboard">
                <i class="fas fa-fw fa-tachometer-alt text-primary"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/managepatient">
                <i class="fas fa-user fa-fw text-primary"></i>
                <span>Vaccine Infants</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="activity">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Feedbacks</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/admin/adduser">
                <i class="fas fa-money-bill fa-fw text-primary"></i>
                <span>Create an Account</span></a>
        </li>
    @elseif ($user->user_type_id == UserTypeEnum::PARENT)
        <!-- Show specific navigation options for parent -->
        <li class="nav-item active">
            <a class="nav-link" href="/parent/dashboard">
                <i class="fas fa-user fa-fw text-primary"></i>
                <span>Infant Vaccination</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/parent/vaccines">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Vaccine Description and Information</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/parent/recommendedvaccinesandschedules">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Recommended Vaccines and Schedules</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/parent/feedback">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Submit Feedback</span></a>
        </li>

    @elseif ($user->user_type_id == UserTypeEnum::HEALTHCARE_PROVIDER)
        <!-- Show specific navigation options for healthcare provider -->
        <li class="nav-item active">
            <a class="nav-link" href="/healthcare_provider/dashboard">
                <i class="fas fa-user fa-fw text-primary"></i>
                <span>Infant Vaccination</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/healthcare_provider/feedback">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Submit Feedback</span></a>
        </li>
    @endif
</ul>
<!-- Sidebar -->
