<nav
    class="border-b border-opacity-25 border-sky-300 bg-sky-600"
    x-data="{ mobileMenuOpen: false, userMenuOpen: false }">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center px-2 lg:px-0">
                <div class="hidden sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-sky-700 text-white", Default: "text-white hover:bg-sky-500 hover:bg-opacity-75" -->
                        <a
                            href="./customers"
                            class="px-3 py-2 text-sm font-medium text-white rounded-md bg-sky-700">Customers</a>
                        <a
                            href="./transactions"
                            class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-sky-500 hover:bg-opacity-75">Transactions</a>
                    </div>
                </div>
            </div>
            <div class="hidden gap-2 sm:ml-6 sm:flex sm:items-center">
                <!-- Profile dropdown -->
                <div class="relative ml-3" x-data="{ open: false }">
                    <div>
                        <button
                            @click="open = !open"
                            type="button"
                            class="flex text-sm bg-white rounded-full focus:outline-none"
                            id="user-menu-button"
                            aria-expanded="false"
                            aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <?php
                            $user = $_SESSION['user'];
                            $userName = $user['first_name'] . ' '. $user['last_name'];
                            $userEmail = $user['email'];
                            $avatarUrl = 'https://ui-avatars.com/api/?size=512&background=random&name=' . urlencode($userName);
                            ?>
                            <img class="w-10 h-10 rounded-full" src="<?= $avatarUrl; ?>" alt="<?= $userName; ?>" />
                        </button>
                    </div>

                    <!-- Dropdown menu -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="user-menu-button"
                        tabindex="-1">
                        <a
                            href="./logout"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem"
                            tabindex="-1"
                            id="user-menu-item-2">Sign out</a>
                    </div>
                </div>
            </div>
            <div class="flex items-center -mr-2 sm:hidden">
                <!-- Mobile menu button -->
                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-sky-100 hover:bg-sky-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500"
                    aria-controls="mobile-menu"
                    aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg
                        x-show="!mobileMenuOpen"
                        class="block w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <!-- Icon when menu is open -->
                    <svg
                        x-show="mobileMenuOpen"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <?php
    include_once __DIR__ . '/../partials/nav-mobile.php';
    ?>

</nav>