(function () {
    const loader = document.getElementById('pageLoader');
    if (!loader) return;

    let armed = false;

    function showLoader() {
        if (armed) return;
        armed = true;
        loader.classList.add('is-active');
    }

    function shouldSkipLink(link, event) {
        if (!link || event.defaultPrevented) return true;
        if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return true;
        if (link.target && link.target !== '_self') return true;
        if (link.hasAttribute('download')) return true;
        if ((link.getAttribute('href') || '').startsWith('#')) return true;
        if (link.protocol && !['http:', 'https:'].includes(link.protocol)) return true;
        if (link.href === window.location.href || link.href === window.location.href + '#') return true;
        return false;
    }

    document.addEventListener('click', function (event) {
        const link = event.target.closest('a');
        if (shouldSkipLink(link, event)) return;
        showLoader();
    });

    document.addEventListener('submit', function (event) {
        if (event.defaultPrevented) return;
        const form = event.target;
        if (form && form.target && form.target !== '_self') return;
        setTimeout(function () {
            if (!event.defaultPrevented) showLoader();
        }, 0);
    }, true);

    window.addEventListener('pageshow', function () {
        armed = false;
        loader.classList.remove('is-active');
    });

    window.showPageLoader = showLoader;
})();
