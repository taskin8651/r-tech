<style>
    .page-loader {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: grid;
        place-items: center;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        background: rgba(7, 9, 25, .78);
        backdrop-filter: blur(16px);
        transition: opacity .22s ease, visibility .22s ease;
    }

    .page-loader.is-active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .page-loader-box {
        width: min(86vw, 330px);
        padding: 26px;
        border: 1px solid rgba(255, 255, 255, .16);
        border-radius: 10px;
        background: linear-gradient(145deg, rgba(255, 255, 255, .14), rgba(255, 255, 255, .06));
        box-shadow: 0 24px 80px rgba(0, 0, 0, .34);
        color: #f8fbff;
        text-align: center;
        font-family: "Plus Jakarta Sans", "Instrument Sans", system-ui, sans-serif;
    }

    .page-loader-mark {
        width: 66px;
        height: 66px;
        margin: 0 auto 16px;
        display: grid;
        place-items: center;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, .18);
        color: #23d3ff;
        font-weight: 800;
        letter-spacing: .04em;
        background: rgba(255, 255, 255, .08);
        animation: loaderFloat 1.3s ease-in-out infinite;
    }

    .page-loader-text {
        margin: 0 0 14px;
        font-size: 14px;
        font-weight: 800;
    }

    .page-loader-line {
        height: 3px;
        overflow: hidden;
        border-radius: 999px;
        background: rgba(255, 255, 255, .14);
    }

    .page-loader-line i {
        display: block;
        width: 46%;
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, #23d3ff, #6ef3cb);
        animation: loaderLine 1s ease-in-out infinite;
    }

    @keyframes loaderFloat {
        50% { transform: translateY(-8px) rotateX(8deg) rotateY(-8deg); }
    }

    @keyframes loaderLine {
        0% { transform: translateX(-110%); }
        100% { transform: translateX(230%); }
    }
</style>

<div class="page-loader" id="pageLoader" aria-hidden="true">
    <div class="page-loader-box">
        <div class="page-loader-mark">RT</div>
        <p class="page-loader-text">Loading, please wait...</p>
        <div class="page-loader-line"><i></i></div>
    </div>
</div>

<script src="{{ asset('js/page-loader.js') }}?v=20260702f" defer></script>
