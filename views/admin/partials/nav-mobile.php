<!-- Mobile menu, show/hide based on menu state. -->
<div x-show="mobileMenuOpen" class="sm:hidden" id="mobile-menu">
    <div class="pt-2 pb-3 space-y-1">
        <a
            href="./customers"
            class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-sky-500 hover:bg-opacity-75">Customers</a>
        <a
            href="./transactions"
            class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-sky-500 hover:bg-opacity-75">Transactions</a>
    </div>
    <div class="pt-4 pb-3 border-t border-sky-700">
        <div class="flex items-center px-5">
            <div class="flex-shrink-0">
            <img
                  class="w-10 h-10 rounded-full"
                  src="<?= $avatarUrl; ?>"
                  alt="<?= $userName; ?>" />
            </div>
            <div class="ml-3">
                <div class="text-base font-medium text-white">
                <?= $userName; ?>
                </div>
                <div class="text-sm font-medium text-sky-300">
                <?= $userEmail; ?>
                </div>
            </div>
            <button
                type="button"
                class="flex-shrink-0 p-1 ml-auto rounded-full bg-sky-600 text-sky-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-sky-600">
                <span class="sr-only">View notifications</span>
                <svg
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </button>
        </div>
        <div class="px-2 mt-3 space-y-1">
            <a
                href="./logout"
                class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-sky-500 hover:bg-opacity-75">Sign out</a>
        </div>
    </div>
</div>