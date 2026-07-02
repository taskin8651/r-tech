<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="R Tech Computer offers practical computer courses including DCA, Tally, MS Office, Web Designing and job-ready digital skills.">
    <title>R Tech Computer | Practical Computer Courses</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|jetbrains-mono:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}?v=20260702">
</head>
<body class="landing-page">
    @include('partials.page-loader')
    @include('partials.frontend-header')
    <div class="preloader" id="preloader" aria-hidden="true">
        <div class="loader-mark">
            <div class="loader-logo"><span>RT</span></div>
            <div class="loader-line"><i></i></div>
            <div class="hud" style="justify-content:center"><span>Loading learning scene</span><span>WebGL style motion</span></div>
        </div>
    </div>

    <div class="cursor-glow" id="cursorGlow"></div>

    <main class="site">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="hud reveal">
                        <span>DCA / Tally / Web</span>
                        <span>Practical Training</span>
                        <span>Certificate Courses</span>
                    </div>
                    <h1 class="reveal">Practical computer courses for better career skills.</h1>
                    <p class="hero-copy reveal">
                        Learn DCA, Tally, MS Office, Web Designing, Typing, Digital Marketing and other job-ready computer skills with structured lessons, practice work and certificate support.
                    </p>
                    <div class="hero-actions reveal">
                        <a class="btn primary magnetic" href="{{ route('courses.index') }}">Explore Courses</a>
                        <a class="btn magnetic" href="{{ route('enquiry.create') }}">Send Enquiry</a>
                    </div>
                </div>
                <div class="stage" aria-label="Animated platform preview">
                    <div class="orbit"></div>
                    <div class="device tilt">
                        <div class="device-top"><i class="dot"></i><i class="dot"></i><i class="dot"></i></div>
                        <div class="dash-grid">
                            <div class="dash-card"><strong>DCA</strong><span>Computer fundamentals and office work</span><div class="bar"><i></i></div></div>
                            <div class="dash-card"><strong>Tally</strong><span>Accounting, GST and reports</span><div class="bar"><i></i></div></div>
                            <div class="dash-card"><strong>Web</strong><span>HTML, CSS and responsive pages</span><div class="bar"><i></i></div></div>
                            <div class="dash-card"><strong>MS</strong><span>Word, Excel, PowerPoint and internet</span><div class="bar"><i></i></div></div>
                        </div>
                    </div>
                    <div class="certificate tilt" id="certificate">
                        <div class="eyebrow">Course Certificate</div>
                        <h3>Uploaded Certificate</h3>
                        <div class="cert-line"></div>
                        <div class="cert-line short"></div>
                        <div class="hud" style="margin:16px 0 0"><span>Public Verify</span><span>Course Record</span></div>
                    </div>
                    <div class="mini-card one"><div class="tag">Practice</div><strong>Projects</strong><br><span>Assignments and tasks</span></div>
                    <div class="mini-card two"><div class="tag">Career</div><strong>Skills</strong><br><span>Office-ready learning</span></div>
                </div>
            </div>
        </section>

        <section class="section reveal" id="benefits">
            <div class="section-head">
                <div class="eyebrow">Why Choose R Tech Computer</div>
                <h2>Focused training for students, job seekers and small business work.</h2>
            </div>
            <p class="section-copy">Courses are designed around practical use: office documents, accounting entries, internet tasks, web basics, typing speed, creative tools and real assignment practice.</p>
            <div class="stats" style="margin-top:30px">
                <div class="stat tilt"><strong>DCA</strong><span>Computer basics, MS Office and internet</span></div>
                <div class="stat tilt"><strong>Tally</strong><span>GST-ready accounting practice</span></div>
                <div class="stat tilt"><strong>Web</strong><span>Website design and publishing basics</span></div>
                <div class="stat tilt"><strong>Cert.</strong><span>Uploaded certificate after completion</span></div>
            </div>
        </section>

        <section class="section" id="courses">
            <div class="course-slider-head reveal">
                <div class="section-head">
                    <div class="eyebrow">Popular Courses</div>
                    <h2>Choose a course and start with clear syllabus, fees and duration.</h2>
                    <p class="section-copy">Browse practical courses like Basic Computer, DCA, ADCA, Tally, DTP, Web Designing, Programming, MS Office, Typing, Digital Marketing, Graphic Designing and Data Entry.</p>
                </div>
                <div class="course-slider-actions" aria-label="Course slider controls">
                    <button class="slider-btn" type="button" data-course-prev aria-label="Previous course">&lsaquo;</button>
                    <button class="slider-btn" type="button" data-course-next aria-label="Next course">&rsaquo;</button>
                </div>
            </div>

            <div class="course-slider reveal" data-course-slider>
                <div class="course-slider-viewport">
                    <div class="course-slider-track" data-course-track>
                        @forelse($featuredCourses as $course)
                            <div class="course-card-slide">
                                <a class="course-item tilt" href="{{ route('courses.show', $course) }}">
                                    <div class="course-thumb"><img src="{{ $course->image_url }}" alt="{{ $course->title }}"></div>
                                    <div class="course-card-body">
                                        <div>
                                            <h3>{{ $course->title }}</h3>
                                            <p>{{ $course->short_description ?: 'Practical course with lessons, assignments and certificate support.' }}</p>
                                        </div>
                                        <div class="course-meta">
                                            @if($course->duration)<span>{{ $course->duration }}</span>@endif
                                            @if($course->level)<span>{{ $course->level }}</span>@endif
                                            @if($course->has_certificate)<span>Certificate</span>@endif
                                            <span>{{ $course->category->name ?? 'Computer Course' }}</span>
                                        </div>
                                        <span class="price">Rs. {{ number_format($course->display_price, 0) }} <i>&rarr;</i></span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="course-card-slide">
                                <a class="course-item tilt" href="{{ route('courses.index') }}">
                                    <div class="course-icon">DCA</div>
                                    <div class="course-card-body">
                                        <div><h3>Diploma in Computer Applications</h3><p>Practical computer basics, MS Office, internet and assignments.</p></div>
                                        <div class="course-meta"><span>Beginner</span><span>Certificate</span></div>
                                        <span class="price">Enroll <i>&rarr;</i></span>
                                    </div>
                                </a>
                            </div>
                            <div class="course-card-slide">
                                <a class="course-item tilt" href="{{ route('courses.index') }}">
                                    <div class="course-icon">TLY</div>
                                    <div class="course-card-body">
                                        <div><h3>Tally & Accounting</h3><p>GST billing, ledger, voucher entry and report practice.</p></div>
                                        <div class="course-meta"><span>Accounting</span><span>Certificate</span></div>
                                        <span class="price">View <i>&rarr;</i></span>
                                    </div>
                                </a>
                            </div>
                            <div class="course-card-slide">
                                <a class="course-item tilt" href="{{ route('courses.index') }}">
                                    <div class="course-icon">WEB</div>
                                    <div class="course-card-body">
                                        <div><h3>Web Designing</h3><p>HTML, CSS, responsive layouts and website basics.</p></div>
                                        <div class="course-meta"><span>Frontend</span><span>Certificate</span></div>
                                        <span class="price">Learn <i>&rarr;</i></span>
                                    </div>
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="course-slider-dots" data-course-dots></div>
            </div>
        </section>

        <section class="section">
            <div class="section-head reveal">
                <div class="eyebrow">Learning Process</div>
                <h2>Simple admission flow with practical learning at every step.</h2>
            </div>
            <div class="flow-grid">
                <div class="flow reveal tilt"><span class="tag">Step 1</span><h3>Select Course</h3><p>Check syllabus, duration, course image, level and fees before enquiry or enrollment.</p></div>
                <div class="flow reveal tilt"><span class="tag">Step 2</span><h3>Practice Lessons</h3><p>Learn topic-wise with practical tasks, notes, examples and regular revision.</p></div>
                <div class="flow reveal tilt"><span class="tag">Step 3</span><h3>Build Skills</h3><p>Work on office documents, accounting entries, web pages and computer-based assignments.</p></div>
                <div class="flow reveal tilt"><span class="tag">Step 4</span><h3>Track Progress</h3><p>Course progress helps students know what is completed and what is pending.</p></div>
                <div class="flow reveal tilt"><span class="tag">Step 5</span><h3>Complete Course</h3><p>After verification, institute uploads the final certificate for student access.</p></div>
                <div class="flow reveal tilt"><span class="tag">Step 6</span><h3>Verify Certificate</h3><p>Certificate records can be checked publicly using the certificate ID.</p></div>
            </div>
        </section>

        <section class="section">
            <div class="section-head reveal">
                <div class="eyebrow">What You Learn</div>
                <h2>Important skills covered across computer courses.</h2>
            </div>
            <div class="feature-grid">
                <div class="feature reveal tilt"><span class="tag">Office</span><h3>MS Word, Excel, PowerPoint</h3><p>Documents, formulas, tables, presentations, printing and daily office use.</p></div>
                <div class="feature reveal tilt"><span class="tag">Accounting</span><h3>Tally Prime with GST</h3><p>Company creation, ledger, voucher, GST billing, reports and practical entries.</p></div>
                <div class="feature reveal tilt"><span class="tag">Design</span><h3>DTP & Graphic Basics</h3><p>Poster, certificate, visiting card, page layout and creative tool practice.</p></div>
                <div class="feature reveal tilt"><span class="tag">Web</span><h3>HTML, CSS, Responsive Design</h3><p>Website structure, styling, layout, forms and publishing basics.</p></div>
                <div class="feature reveal tilt"><span class="tag">Typing</span><h3>Hindi / English Typing</h3><p>Typing speed, accuracy, keyboard practice and exam-oriented preparation.</p></div>
                <div class="feature reveal tilt"><span class="tag">Digital</span><h3>Internet & Digital Skills</h3><p>Email, online forms, browsing, file handling, data entry and digital tools.</p></div>
            </div>
        </section>

        <section class="section" id="certificate">
            <div class="section-head reveal">
                <div class="eyebrow">Certificate Support</div>
                <h2>Course completion certificate with public verification.</h2>
            </div>
            <div class="timeline-list">
                <div class="timeline reveal"><span class="phase">Learn</span><div><h3>Complete lessons and practice</h3><p>Students complete course topics, assignments and required practical work.</p></div><strong>Course-wise</strong></div>
                <div class="timeline reveal"><span class="phase">Review</span><div><h3>Institute verification</h3><p>Course completion is checked before issuing the final certificate file.</p></div><strong>Manual</strong></div>
                <div class="timeline reveal"><span class="phase">Upload</span><div><h3>Certificate added by admin</h3><p>The certificate is uploaded for the student and linked with a certificate ID.</p></div><strong>Secure</strong></div>
                <div class="timeline reveal"><span class="phase">Verify</span><div><h3>Public certificate check</h3><p>Anyone can verify a valid certificate record using the verification page.</p></div><strong>Online</strong></div>
            </div>
        </section>

        <section class="section" id="contact">
            <div class="contact-panel reveal">
                <div>
                    <div class="eyebrow">Admissions Open</div>
                    <h2>Find the right computer course and ask for details.</h2>
                </div>
                <a class="btn primary magnetic" href="{{ route('enquiry.create') }}">Send Enquiry</a>
            </div>
        </section>

    </main>
    @include('partials.frontend-footer')

    <script src="{{ asset('js/frontend.js') }}?v=20260702" defer></script>
</body>
</html>
