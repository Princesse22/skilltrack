<!-- ================= FOOTER ================= -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5 class="text-white">SkillTract</h5>
                <p>E-learning platform for everyone.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-white">Links</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/courses') }}">Courses</a></li>
                    <li><a href="{{ url('/mentors') }}">Mentors</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white">Contact</h6>
                <p>contact@skilltract.com</p>
            </div>
        </div>
        <hr>
        <p class="text-center mb-0">© {{ date('Y') }} SkillTract</p>
    </div>
</footer>
