@php
    use Illuminate\Support\Facades\Auth;
    use App\Enums\UserTypeEnum;
@endphp

<nav style="background-color: #C8A796" class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars text-dark"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">

                @if (Auth::user()->user_type_id == UserTypeEnum::ADMINISTRATOR)
                <img class="img-profile rounded-circle" src="/images/admin_icon.png" style="max-width: 60px">
                @endif


                @if (Auth::user()->user_type_id == UserTypeEnum::HEALTHCARE_PROVIDER)
                <img class="img-profile rounded-circle" src="/images/hp_icon.png" style="max-width: 60px">
                @endif


                @if (Auth::user()->user_type_id == UserTypeEnum::PARENT)
                <img class="img-profile rounded-circle" src="/images/parent_icon.png" style="max-width: 60px">
                @endif


                <span class="ml-2 d-none d-lg-inline text-white small">
                    @auth
                        {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}
                    @endauth

                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                @if (Auth::user()->user_type_id == UserTypeEnum::ADMINISTRATOR)
                    <a class="dropdown-item" href="/admin/profile">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                @endif
                @if (Auth::user()->user_type_id == UserTypeEnum::HEALTHCARE_PROVIDER)
                    <a class="dropdown-item" href="/healthcare_provider/profile">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                @endif
                @if (Auth::user()->user_type_id == UserTypeEnum::PARENT)
                    <a class="dropdown-item" href="/parent/profile">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                @endif
                <a class="dropdown-item" href="/logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
