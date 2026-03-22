<!-- ================= HEADER ================= -->
<style>
/* ===== LIGNE 1 : top-bar ===== */
.top-bar {
    background-color: #f8f9fa;
    border-bottom: 2px solid #0d6efd;
    padding: 0.8rem 0;
    width: 100%;
    position: relative;
    z-index: 1000;
    overflow: visible;
}

/* ===== LIGNE 2 : menu centré ===== */
.main-nav {
    background-color: #ffffff;
    padding: 0.8rem 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    width: 100%;
    position: relative;
    z-index: 50;
}

/* ===== DROPDOWN PROFIL au-dessus de tout ===== */
.top-bar .dropdown-menu {
    z-index: 1050;
}

.nav-link {
    position: relative;
    transition: color 0.3s ease;
    font-size: 1.1rem;
}

.nav-link:hover {
    color: #0d6efd !important;
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    bottom: -6px;
    left: 50%;
    background-color: #0d6efd;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::after,
.nav-link.active::after {
    width: 80%;
}

.nav-link.active {
    color: #0d6efd !important;
    font-weight: 600;
}

/* ===== MOBILE ===== */
@media (max-width: 991px) {
    .top-bar {
        border-bottom: none;
    }
}
</style>
<link rel="stylesheet" href="{{ asset('css/style/formation.css') }}">

<!-- ========== LIGNE 1 : LOGO À GAUCHE + BOUTONS À DROITE ========== -->
<div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Logo à gauche -->
        <a class="navbar-brand fw-bold mb-0" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="SkillTract Logo" style="height: 50px; width: auto; object-fit: contain; display: block;">
        </a>

        <!-- Boutons d'action desktop -->
        <div class="d-none d-lg-flex align-items-center gap-2">
            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginPopupForm">
                <i class="la la-sign-in"></i> Login
            </a>
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupPopupForm">
                <i class="la la-user-plus"></i> Sign Up
            </a>
<div class="dropdown">
    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="la la-user"></i> Profil
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ url('/profile/edit') }}">
                <i class="la la-edit"></i> Modifier
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('partenaire.dashboard') }}">
                <i class="la la-dashboard"></i> Dashboard
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="la la-sign-out"></i> Déconnexion
            </a>
        </li>
    </ul>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
            <a class="btn btn-outline-secondary" href="{{ route('partenaire.index') }}">
                <i class="la la-handshake"></i> Devenir partenaire
            </a>
        </div>

        <!-- Toggler mobile -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</div>

<!-- ========== LIGNE 2 : MENU PRINCIPAL CENTRÉ ========== -->
<div class="main-nav d-none d-lg-block">
    <div class="container">
        <ul class="navbar-nav flex-row justify-content-center">
            <li class="nav-item mx-4">
                <a class="nav-link fw-semibold {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                    🏠 Home
                </a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link fw-semibold {{ Request::is('courses*') ? 'active' : '' }}" href="{{ route('formations.index') }}">
                    📚 Nos formations
                </a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link fw-semibold {{ Request::is('mentors*') ? 'active' : '' }}" href="{{ url('/mentors') }}">
                    👨‍🏫 Mentors
                </a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link fw-semibold {{ Request::is('blog*') ? 'active' : '' }}" href="{{ url('/blog') }}">
                    📝 Blog
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- ========== MENU MOBILE COLLAPSIBLE ========== -->
<div class="collapse" id="navbarContent">
    <div class="container pb-3">
        <ul class="navbar-nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link fw-semibold {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">🏠 Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold {{ Request::is('courses*') ? 'active' : '' }}" href="{{ url('/courses') }}">📚 Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold {{ Request::is('mentors*') ? 'active' : '' }}" href="{{ url('/mentors') }}">👨‍🏫 Mentors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold {{ Request::is('blog*') ? 'active' : '' }}" href="{{ url('/blog') }}">📝 Blog</a>
            </li>
        </ul>
        <div class="d-flex flex-column gap-2">
            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginPopupForm">
                <i class="la la-sign-in"></i> Login
            </a>
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupPopupForm">
                <i class="la la-user-plus"></i> Sign Up
            </a>
            <a class="btn btn-outline-primary" href="{{ url('/profile') }}">
                <i class="la la-user"></i> Profil
            </a>
            <a class="btn btn-outline-secondary" href="{{ url('/partner') }}">
                <i class="la la-handshake"></i> Devenir partenaire
            </a>
        </div>
    </div>
</div>

<!-- Login Modal Popup -->
<div class="modal fade" id="loginPopupForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title title">Login</h5>
                    <p class="font-size-14">Hello! Welcome Back</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-form-action">
                    <form method="POST" action="">
                        {{-- {{ route('login.submit') }} --}}
                        @csrf

                        <!-- Email Address -->
                        <div class="input-box mb-3">
                            <label class="label-text">Email Address</label>
                            <div class="form-group">
                                <span class="la la-envelope form-icon"></span>
                                <input
                                    class="form-control @error('email') is-invalid @enderror"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Type your email"
                                    required
                                />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="input-box mb-3">
                            <label class="label-text">Password</label>
                            <div class="form-group">
                                <span class="la la-lock form-icon"></span>
                                <input
                                    class="form-control @error('password') is-invalid @enderror"
                                    type="password"
                                    name="password"
                                    placeholder="Type your password"
                                    required
                                />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Remember Me
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="btn-box pt-3 pb-4">
                            <button type="submit" class="theme-btn w-100">
                                Login
                            </button>
                        </div>

                        <!-- Forgot Password -->
                        <div class="text-center mb-3">
                            <a href="" class="text-primary">Forgot Password?</a>
                            {{-- {{ route('password.request') }} --}}
                        </div>

                        <!-- Sign Up Link -->
                        <div class="text-center">
                            <p class="font-size-14">Don't have an account?
                                <a href="#" class="text-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signupPopupForm">Sign Up</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end login modal -->

<!-- Signup Modal Popup -->
<div class="modal fade" id="signupPopupForm" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                    <p class="font-size-14">Hello! Welcome Create a New Account</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-form-action">
                    <form method="POST" action="">
                        {{-- {{ route('register') }} --}}
                        @csrf

                        <!-- Username -->
                        <div class="input-box mb-3">
                            <label class="label-text">Username<span class="req">*</span></label>
                            <div class="form-group">
                                <span class="la la-user form-icon"></span>
                                <input
                                    class="form-control @error('username') is-invalid @enderror"
                                    type="text"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="Type your username"
                                    required
                                />
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="input-box mb-3">
                            <label class="label-text">Email Address <span class="req">*</span></label>
                            <div class="form-group">
                                <span class="la la-envelope form-icon"></span>
                                <input
                                    class="form-control @error('email') is-invalid @enderror"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Type your email"
                                    required
                                />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="input-box mb-3">
                            <label class="label-text">Password <span class="req">*</span></label>
                            <div class="form-group">
                                <span class="la la-lock form-icon"></span>
                                <input
                                    class="form-control @error('password') is-invalid @enderror"
                                    type="password"
                                    name="password"
                                    placeholder="Type password"
                                    required
                                />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Repeat Password -->
                        <div class="input-box mb-3">
                            <label class="label-text">Repeat Password <span class="req">*</span></label>
                            <div class="form-group">
                                <span class="la la-lock form-icon"></span>
                                <input
                                    class="form-control"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Type again password"
                                    required
                                />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="btn-box pt-3 pb-4">
                            <button type="submit" class="theme-btn w-100">
                                Register Account
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="font-size-14">Already have an account?
                                <a href="#" class="text-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginPopupForm">Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end signup modal -->

<script>
document.addEventListener('DOMContentLoaded', function() {

    const loginModal = document.getElementById('loginPopupForm');
    if (loginModal) {
        loginModal.addEventListener('shown.bs.modal', function () {
            const firstInput = this.querySelector('input[type="email"]');
            if (firstInput) firstInput.focus();
        });
    }

    const signupModal = document.getElementById('signupPopupForm');
    if (signupModal) {
        signupModal.addEventListener('shown.bs.modal', function () {
            const firstInput = this.querySelector('input[type="text"]');
            if (firstInput) firstInput.focus();
        });

        signupModal.addEventListener('hidden.bs.modal', function () {
            const form = this.querySelector('form');
            if (form) {
                form.reset();
                this.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');
                this.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            }
        });
    }
});
</script>
