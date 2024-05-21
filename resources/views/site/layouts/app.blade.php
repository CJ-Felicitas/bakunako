<!DOCTYPE html>
<html lang="en">

<head>
    @include('site.layouts.header')
    @yield('custom-css')
    <title>@yield('title')</title>
    @yield('custom-script-header')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('site.layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('site.layouts.topbar')
                <div class="container-fluid" id="container-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Floating Widget Button -->
    <button type="button" class="btn btn-primary" style="
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 1000;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    " data-toggle="modal" data-target="#contactModal">
        <i class="fas fa-envelope"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contact Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Email:</strong> admin@example.com</p>
                    <p><strong>Phone Number:</strong> (123) 456-7890</p>
                    <p><strong>Telephone Number:</strong> (098) 765-4321</p>
                    <p><strong>Address:</strong> 123 Admin Street, Admin City, Admin Country</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('site.layouts.script')
    @yield('custom-script')
</body>

</html>
