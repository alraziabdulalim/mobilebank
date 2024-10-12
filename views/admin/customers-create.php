<?php
$is_logged_in = isset($_SESSION['user']);

if (!$is_logged_in) {
    header("Location: ../login");
    exit;
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$request = $_SESSION['sanitizedRequest'] ?? [];
unset($_SESSION['sanitizedRequest']);

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Tailwindcss CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        * {
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans",
                "Helvetica Neue", sans-serif;
        }
    </style>

    <title>All Customers</title>
</head>

<body class="h-full">
    <div class="min-h-full">
        <div class="pb-32 bg-sky-600">
            <?php
            include_once __DIR__ . '/partials/nav.php';
            ?>
            <header class="py-10">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        Add a New Customer
                    </h1>
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="py-8 bg-white rounded-lg">
                    <!-- List of All The Customers -->
                    <?php
                    include_once __DIR__ . '/partials/create-customer-form.php';
                    ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>