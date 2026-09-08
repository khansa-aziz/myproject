<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>AdminLTE v4 | Dashboard</title>

    <!-- Theme Init -->
    <script>
        (() => {
            'use strict';

            const root = document.documentElement;

            if (root.getAttribute('data-lte-color-mode') === 'off') {
                return;
            }

            const STORAGE_KEY = 'lte-theme';
            let stored = null;

            try {
                stored = localStorage.getItem(STORAGE_KEY);
            } catch {}

            const authored = root.getAttribute('data-bs-theme');

            let resolved = 'light';

            if (stored === 'dark' || stored === 'light') {
                resolved = stored;
            } else if (authored === 'dark' || authored === 'light') {
                resolved = authored;
            } else if (
                globalThis.matchMedia('(prefers-color-scheme: dark)').matches
            ) {
                resolved = 'dark';
            }

            root.setAttribute('data-bs-theme', resolved);
            root.style.colorScheme = resolved;

            if (resolved !== authored) {
                root.setAttribute('data-lte-theme-resolved', '');
            }
        })();
    </script>

    <!-- Meta Tags -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=yes" />

    <meta name="color-scheme" content="light dark" />

    <meta
        name="theme-color"
        content="#007bff"
        media="(prefers-color-scheme: light)" />

    <meta
        name="theme-color"
        content="#1a1a1a"
        media="(prefers-color-scheme: dark)" />

    <meta name="title" content="AdminLTE v4 | Dashboard" />

    <meta name="author" content="ColorlibHQ" />

    <meta
        name="description"
        content="AdminLTE is a free Bootstrap 5 admin dashboard template." />

    <meta
        name="keywords"
        content="bootstrap 5, admin dashboard, AdminLTE" />

    <meta
        name="supported-color-schemes"
        content="light dark" />

    <!-- AdminLTE CSS -->
    <link
        rel="preload"
        href="{{ asset('adminlte.css') }}"
        as="style" />
    <!-- Bootstrap CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        crossorigin="anonymous" />

    <!-- Fonts -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous"
        media="print"
        onload="this.media = 'all'" />

    <!-- OverlayScrollbars -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />

    <!-- AdminLTE -->
    <link
        rel="stylesheet"
        href="{{ asset('adminlte.css') }}" />

    <!-- ApexCharts -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        crossorigin="anonymous" />

    <!-- JSVectorMap -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        crossorigin="anonymous" />
</head>


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        <!-- Header -->
       @include('admin.layout.header')

        <!-- Sidebar -->
       @include('admin.layout.sidebar')

        <!-- Main Content -->
        <main class="app-main">

            @yield('content')

        </main>

        <!-- Footer -->
        @include('admin.layout.footer')
        <script src="{{ asset('js/adminlte.js') }}"></script>

    </div>
   <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';

    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };

    document.addEventListener('DOMContentLoaded', function() {

        const sidebarWrapper = document.querySelector(
            SELECTOR_SIDEBAR_WRAPPER
        );

        const isMobile = window.innerWidth <= 992;

        if (
            sidebarWrapper &&
            OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
            !isMobile
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(
                sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                }
            );
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
</body>

</html>