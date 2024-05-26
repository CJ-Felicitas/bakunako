<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button
                data-mdb-collapse-init
                class="navbar-toggler"
                type="button"
                data-mdb-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="#">
                    <img
                        src="/images/navbar1-logo.webp"
                        height="40"
                        alt="MDB Logo"
                        loading="lazy"
                    />
                </a>
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <!-- Left links -->
                <!-- Right links -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown"> <!-- Added 'dropdown' class here -->
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login As
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/login_healthcareprovider">Healthcare Provider</a>
                            <a class="dropdown-item" href="/login_parent">Parent</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/register">Register</a>
                    </li>
                </ul>
                <!-- Right links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->

            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
