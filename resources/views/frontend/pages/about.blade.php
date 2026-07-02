@extends('layouts.frontend')

@section('title', 'About R Tech Computer | Practical Computer Training')
@section('meta_description', 'Learn about R Tech Computer, a practical computer training institute for DCA, Tally, MS Office, Web Designing, digital skills and certificate courses.')
@section('meta_keywords', 'about R Tech Computer, computer training institute, DCA course, Tally course, computer certificate')

@section('content')
<section class="about-hero">
    <div class="wrap grid grid-2" style="align-items:center">
        <div>
            <div class="eyebrow">About R Tech Computer</div>
            <h1 class="about-title">Practical computer education for career-ready skills.</h1>
            <p class="about-lead">{{ $settings->about_intro ?: 'R Tech Computer helps students learn useful computer skills through structured courses, hands-on practice, online lessons and completion certificate support.' }}</p>
            <div class="about-actions">
                <a class="btn primary" href="{{ route('courses.index') }}">Explore Courses</a>
                <a class="btn" href="{{ route('enquiry.create') }}">Admission Enquiry</a>
            </div>
        </div>
        <div class="about-visual">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1400&q=80" alt="Computer training classroom">
        </div>
    </div>
</section>

<section class="page" style="padding-top:34px">
    <div class="wrap">
        <div class="grid grid-3">
            <div class="card about-stat"><strong>DCA</strong><span>Computer basics, office tools and internet skills.</span></div>
            <div class="card about-stat"><strong>Tally</strong><span>Accounting, GST billing and business reports.</span></div>
            <div class="card about-stat"><strong>Cert.</strong><span>Certificate uploaded after completion verification.</span></div>
        </div>

        <div class="grid grid-2" style="margin-top:24px;align-items:start">
            <div class="card">
                <span class="pill">Institute Story</span>
                <h2>Learning that stays close to real computer work.</h2>
                <p class="muted">R Tech Computer focuses on the skills students actually need: typing, office work, accounting entries, internet tasks, web basics, digital tools and practical assignments. Every course is organized with clear duration, level, syllabus and certificate support.</p>
            </div>
            <div class="card about-list">
                <div class="about-point"><div class="about-no">01</div><div><h3>Skill-based training</h3><p>Courses are built around job-ready practice instead of only theory.</p></div></div>
                <div class="about-point"><div class="about-no">02</div><div><h3>Structured courses</h3><p>Students can see course details, lessons, duration, fees and certificate availability.</p></div></div>
                <div class="about-point"><div class="about-no">03</div><div><h3>Certificate support</h3><p>After completion, admin uploads the certificate file and students can access it from their account.</p></div></div>
            </div>
        </div>

        <div class="grid grid-2" style="margin-top:24px">
            <div class="card">
                <span class="pill">Mission</span>
                <h2>{{ $settings->mission ?: 'Affordable, practical and career-focused computer education.' }}</h2>
                <p class="muted">Our mission is to help students become confident with computers through practical lessons, assignments and guided course completion.</p>
            </div>
            <div class="card">
                <span class="pill">Vision</span>
                <h2>{{ $settings->vision ?: 'Digital confidence for every learner.' }}</h2>
                <p class="muted">We want learners to use computer skills confidently for study, jobs, business, freelancing and daily digital work.</p>
            </div>
        </div>

        <div style="margin-top:34px">
            <div class="eyebrow">Popular Training Areas</div>
            <h2 style="max-width:820px">Courses designed for office, accounting, design and digital work.</h2>
            <div class="course-chip-grid" style="margin-top:22px">
                <div class="course-chip"><strong>Basic Computer</strong><span>Windows, internet, email and daily computer use.</span></div>
                <div class="course-chip"><strong>DCA / ADCA</strong><span>Diploma-level computer application training.</span></div>
                <div class="course-chip"><strong>Tally + GST</strong><span>Ledger, voucher, billing, GST and reports.</span></div>
                <div class="course-chip"><strong>MS Office</strong><span>Word, Excel, PowerPoint and office documents.</span></div>
                <div class="course-chip"><strong>Web Designing</strong><span>HTML, CSS and responsive website basics.</span></div>
                <div class="course-chip"><strong>DTP / Design</strong><span>Print layout, poster, certificate and creative work.</span></div>
                <div class="course-chip"><strong>Typing</strong><span>Hindi and English typing speed with accuracy.</span></div>
                <div class="course-chip"><strong>Digital Skills</strong><span>Online forms, data entry and useful internet tools.</span></div>
            </div>
        </div>

        <div class="certificate-band grid grid-2" style="margin-top:34px;align-items:center">
            <div>
                <span class="pill">Certificate Verification</span>
                <h2>Uploaded certificate records with public verification.</h2>
                <p class="muted">Certificate generate nahi hota; institute completion verify karke certificate file upload karta hai. Student apne account me certificate dekh sakta hai aur certificate ID public verify page par check ho sakti hai.</p>
            </div>
            <div style="display:flex;gap:12px;flex-wrap:wrap;justify-content:flex-end">
                <a class="btn primary" href="{{ route('certificates.verify') }}">Verify Certificate</a>
                <a class="btn" href="{{ route('contact') }}">Contact Institute</a>
            </div>
        </div>
    </div>
</section>
@endsection
