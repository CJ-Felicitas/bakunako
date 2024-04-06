@php
    use Illuminate\Support\Facades\Auth;
    use App\Enums\UserTypeEnum;
    $user = Auth::user();
@endphp
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img width="100%" src="/ruangadminkit/img/markup-logo.png">
        </div>
        <div class="sidebar-brand-text mx-3">Bakunako</div>
    </a>
    <hr class="sidebar-divider my-0">
    @if ($user->user_type_id == UserTypeEnum::ADMINISTRATOR)
        <!-- Check if user is admin -->
        <!-- Show all navigation options -->
        <li class="nav-item active">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt text-primary"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/managepatient">
                <i class="fas fa-user fa-fw text-primary"></i>
                <span>Manage Patients</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="activity">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Activity Logs</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="index.html">
                <i class="fas fa-money-bill fa-fw text-primary"></i>
                <span>Track Revenue</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/admin/staff">
                <i class="fas fa-users fa-fw text-primary"></i>
                <span>Manage Staffs</span></a>
        </li>
    @elseif($user->user_type_id == UserTypeEnum::PARENT)
        <!-- Check if user is staff -->
        <!-- Show only manage patients and activity logs for staff -->
        <li class="nav-item active">
            <a class="nav-link" href="/staff/dashboard">
                <i class="fas fa-user fa-fw text-primary"></i>
                <span>Home</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="/staff/enrollstudent">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Enrollment</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/staff/managestudents">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Manage</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="activity">
                <i class="fas fa-clock fa-fw text-primary"></i>
                <span>Activity Logs</span></a>
        </li>
    @endif
    <hr class="sidebar-divider">

</ul>
<!-- Sidebar -->
