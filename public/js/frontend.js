(function () {
    document.querySelectorAll('[data-menu-toggle]').forEach(function (toggle) {
        const menu = toggle.closest('.site-header')?.querySelector('[data-site-menu]');
        const backdrop = document.querySelector('[data-menu-backdrop]');
        if (!menu) return;

        function setMenu(open) {
            menu.classList.toggle('is-open', open);
            toggle.classList.toggle('is-open', open);
            backdrop?.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            document.body.classList.toggle('menu-open', open);
        }

        toggle.addEventListener('click', function () {
            const isOpen = !menu.classList.contains('is-open');
            setMenu(isOpen);
        });

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                setMenu(false);
            });
        });

        backdrop?.addEventListener('click', function () {
            setMenu(false);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') setMenu(false);
        });
    });

    const preloader = document.getElementById('preloader');
    if (preloader) {
        window.addEventListener('load', function () {
            setTimeout(function () {
                preloader.classList.add('done');
            }, 650);
        });
    }

    const glow = document.getElementById('cursorGlow');
    if (glow) {
        window.addEventListener('pointermove', function (event) {
            glow.style.left = event.clientX + 'px';
            glow.style.top = event.clientY + 'px';
        });
    }

    const revealItems = document.querySelectorAll('.reveal');
    if (revealItems.length) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: .16 });

        revealItems.forEach(function (element, index) {
            element.style.transitionDelay = Math.min(index * 35, 240) + 'ms';
            observer.observe(element);
        });
    }

    document.querySelectorAll('.tilt').forEach(function (card) {
        card.addEventListener('pointermove', function (event) {
            const rect = card.getBoundingClientRect();
            const x = (event.clientX - rect.left) / rect.width - .5;
            const y = (event.clientY - rect.top) / rect.height - .5;
            card.style.transform = 'rotateX(' + (y * -7) + 'deg) rotateY(' + (x * 9) + 'deg) translateY(-3px)';
        });
        card.addEventListener('pointerleave', function () {
            card.style.transform = '';
        });
    });

    document.querySelectorAll('[data-course-slider]').forEach(function (slider) {
        const track = slider.querySelector('[data-course-track]');
        const slides = Array.from(slider.querySelectorAll('.course-card-slide'));
        const dotsWrap = slider.querySelector('[data-course-dots]');
        const previous = document.querySelector('[data-course-prev]');
        const next = document.querySelector('[data-course-next]');
        let current = 0;

        if (!track || !slides.length || !dotsWrap) return;

        function visibleCount() {
            if (window.innerWidth <= 640) return 1;
            if (window.innerWidth <= 980) return 2;
            return 3;
        }

        function maxIndex() {
            return Math.max(0, slides.length - visibleCount());
        }

        function updateSlider() {
            current = Math.min(Math.max(current, 0), maxIndex());
            const slideWidth = slides[0]?.getBoundingClientRect().width || 0;
            const gap = Number.parseFloat(getComputedStyle(track).gap) || 0;
            track.style.transform = 'translateX(-' + (current * (slideWidth + gap)) + 'px)';
            dotsWrap.querySelectorAll('button').forEach(function (dot, index) {
                dot.classList.toggle('active', index === current);
            });
        }

        function renderDots() {
            dotsWrap.innerHTML = '';
            for (let index = 0; index <= maxIndex(); index++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', 'Go to course ' + (index + 1));
                dot.addEventListener('click', function () {
                    current = index;
                    updateSlider();
                });
                dotsWrap.appendChild(dot);
            }
        }

        previous?.addEventListener('click', function () {
            current = current <= 0 ? maxIndex() : current - 1;
            updateSlider();
        });

        next?.addEventListener('click', function () {
            current = current >= maxIndex() ? 0 : current + 1;
            updateSlider();
        });

        window.addEventListener('resize', function () {
            renderDots();
            updateSlider();
        });

        renderDots();
        updateSlider();
    });

    document.querySelectorAll('.magnetic').forEach(function (button) {
        button.addEventListener('pointermove', function (event) {
            const rect = button.getBoundingClientRect();
            const x = event.clientX - rect.left - rect.width / 2;
            const y = event.clientY - rect.top - rect.height / 2;
            button.style.transform = 'translate(' + (x * .12) + 'px, ' + (y * .18) + 'px)';
        });
        button.addEventListener('pointerleave', function () {
            button.style.transform = '';
        });
    });

    document.querySelectorAll('.student-tab').forEach(function (button) {
        button.addEventListener('click', function () {
            document.querySelectorAll('.student-tab').forEach(function (tab) {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-panel').forEach(function (panel) {
                panel.classList.remove('active');
            });
            button.classList.add('active');
            document.getElementById('tab-' + button.dataset.tab)?.classList.add('active');
        });
    });

    const payButton = document.getElementById('payButton');
    if (payButton) {
        payButton.addEventListener('click', function () {
            if (!window.Razorpay) return;

            const checkout = new Razorpay({
                key: payButton.dataset.key,
                amount: payButton.dataset.amount,
                currency: 'INR',
                name: 'R Tech Computer',
                description: payButton.dataset.description,
                order_id: payButton.dataset.orderId,
                handler: function (response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id || '';
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id || '';
                    document.getElementById('razorpay_signature').value = response.razorpay_signature || '';
                    document.getElementById('successForm').submit();
                },
                prefill: {
                    name: payButton.dataset.userName,
                    email: payButton.dataset.userEmail
                },
                theme: { color: '#23d3ff' }
            });

            checkout.open();
        });
    }
})();
