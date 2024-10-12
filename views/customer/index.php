<?php

$is_logged_in = isset($_SESSION['user']);

if (!$is_logged_in) {
  header("Location: ../login");
  exit;
}

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html
    class="h-full bg-gray-100"
    lang="en">

<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0" />

    <!-- Tailwindcss CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Inter Font -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com" />
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
                'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
                'Helvetica Neue', sans-serif;
        }
    </style>

    <title>Dashboard</title>
</head>

<body class="h-full">
    <div class="min-h-full">
        <div class="bg-emerald-600 pb-32">
            <!-- Navigation -->
            <nav
                class="border-b border-emerald-300 border-opacity-25 bg-emerald-600"
                x-data="{ mobileMenuOpen: false, userMenuOpen: false }">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <?php
                    include_once __DIR__ . '/partials/nav.php';
                    ?>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                    <?php
                    include_once __DIR__ . '/partials/nav-mobile.php';
                    ?>
            </nav>
            <header class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        Howdy, <?= $userName; ?> 👋
                    </h1>
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg p-2">
                    <?php
                    include_once __DIR__ . '/partials/transactions.php';
                    ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>