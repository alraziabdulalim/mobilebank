<div class="flex h-16 justify-between">
    <div class="flex items-center px-2 lg:px-0">
        <div class="hidden sm:block">
            <div class="flex space-x-4">
                <!-- Current: "bg-emerald-700 text-white", Default: "text-white hover:bg-emerald-500 hover:bg-opacity-75" -->
                <a href="./dashboard" class="bg-emerald-700 text-white rounded-md py-2 px-3 text-sm font-medium" aria-current="page">Dashboard</a>
                <a href="./deposit" class="text-white hover:bg-emerald-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium">Deposit</a>
                <a href="./withdraw" class="text-white hover:bg-emerald-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium">Withdraw</a>
                <a href="./transfer" class="text-white hover:bg-emerald-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium">Transfer</a>
            </div>
        </div>
    </div>
    <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
        <!-- Profile dropdown -->
        <div class="relative ml-3" x-data="{ open: false }">
            <div>
                <button @click="open = !open" type="button" class="flex rounded-full bg-white text-sm focus:outline-none" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="sr-only">Open user menu</span>
                    <?php
                    $user = $_SESSION['user'];
                    $userName = $user['first_name'] . ' ' . $user['last_name'];
                    $userEmail = $user['email'];
                    $avatarUrl = 'https://ui-avatars.com/api/?size=512&background=random&name=' . urlencode($userName);
                    ?>
                    <img class="w-10 h-10 rounded-full" src="<?= $avatarUrl; ?>" alt="<?= $userName; ?>" />
                </button>
            </div>

            <!-- Dropdown menu -->
            <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" style="display: none;">
                <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
            </div>
        </div>
    </div>
    <div class="-mr-2 flex items-center sm:hidden">
        <!-- Mobile menu button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-emerald-100 hover:bg-emerald-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!-- Icon when menu is closed -->
            <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
            </svg>

            <!-- Icon when menu is open -->
            <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>