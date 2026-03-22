@extends('layouts.app')

@section('title', 'SkillTract')

@section('content')

<!-- ================= HERO ================= -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">
                <span class="badge-offer mb-3 d-inline-block">✔ Learn from expert mentors</span>
                <h1 class="fw-bold mt-3 mb-4">
                    Learn new skills <br> online with experts
                </h1>
                <p class="text-muted mb-4">
                    Build skills with courses, certificates, and mentors.
                </p>
                <a class="btn btn-primary btn-lg me-3" href="{{ route('formations.index') }}">Get Started</a>
                <a class="btn btn-outline-secondary btn-lg" href="{{ url('/courses') }}">Explore</a>
            </div>

            <div class="col-lg-6 text-center">
                <img src="{{ asset("images/learn.png") }}" class="img-fluid" alt="learn Image">
            </div>

        </div>
    </div>
</section>

<!-- ================= WHY CHOOSE SKILLTRACT ================= -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose SkillTract</h2>
            <p class="text-muted">Everything you need to grow your skills</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="why-card text-center">
                    <h5 class="fw-bold">Certified Courses</h5>
                    <p class="text-muted">High-quality courses validated by experts</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="why-card text-center">
                    <h5 class="fw-bold">Skill Tracking</h5>
                    <p class="text-muted">Track your progress and achievements</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="why-card text-center">
                    <h5 class="fw-bold">Flexible Learning</h5>
                    <p class="text-muted">Learn anytime, anywhere at your own pace</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= POPULAR COURSES ================= -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Popular Courses</h2>
            <p class="text-muted">Explore our most popular courses</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="course-card">
                    <img src="https://via.placeholder.com/400x220" class="img-fluid" alt="Web Development Course">
                    <div class="p-4">
                        <h6 class="fw-bold">Web Development</h6>
                        <p class="text-muted">Beginner to advanced</p>
                        <span class="fw-bold">$49</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="course-card">
                    <img src="https://via.placeholder.com/400x220" class="img-fluid" alt="UI/UX Design Course">
                    <div class="p-4">
                        <h6 class="fw-bold">UI/UX Design</h6>
                        <p class="text-muted">Design modern interfaces</p>
                        <span class="fw-bold">$39</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="course-card">
                    <img src="https://via.placeholder.com/400x220" class="img-fluid" alt="Data Science Course">
                    <div class="p-4">
                        <h6 class="fw-bold">Data Science</h6>
                        <p class="text-muted">Analyze real data</p>
                        <span class="fw-bold">$59</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= MENTORS ================= -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Meet with our Mentor</h2>
            <p class="text-muted">Professional & experienced mentors</p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-md-3 mentor">
                <img src="https://via.placeholder.com/120" alt="John Doe">
                <h6 class="fw-bold mt-3">John Doe</h6>
                <p class="text-muted">Web Developer</p>
            </div>
            <div class="col-md-3 mentor">
                <img src="https://via.placeholder.com/120" alt="Sarah Lee">
                <h6 class="fw-bold mt-3">Sarah Lee</h6>
                <p class="text-muted">UI Designer</p>
            </div>
            <div class="col-md-3 mentor">
                <img src="https://via.placeholder.com/120" alt="Alex Smith">
                <h6 class="fw-bold mt-3">Alex Smith</h6>
                <p class="text-muted">Data Scientist</p>
            </div>
            <div class="col-md-3 mentor">
                <img src="https://via.placeholder.com/120" alt="Emma Brown">
                <h6 class="fw-bold mt-3">Emma Brown</h6>
                <p class="text-muted">Marketing Expert</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= NEWSLETTER ================= -->
<div class="container newsletter-wrapper">
    <div class="newsletter">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <h3 class="fw-bold">Subscribe to our newsletter</h3>
                <p>Get the latest courses, updates and offers</p>
            </div>
            <div class="col-lg-6">
                <form class="d-flex" method="POST" action="{{ url('/newsletter/subscribe') }}">
                    @csrf
                    <input type="email" name="email" class="form-control me-2" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-light">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
