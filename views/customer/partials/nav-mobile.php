<div
    x-show="mobileMenuOpen"
    class="sm:hidden"
    id="mobile-menu">
    <div class="space-y-1 pt-2 pb-3">
        <a
            href="./dashboard"
            class="bg-emerald-700 text-white block rounded-md py-2 px-3 text-base font-medium"
            aria-current="page">Dashboard</a>

        <a
            href="./deposit"
            class="text-white hover:bg-emerald-500 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium">Deposit</a>

        <a
            href="./withdraw"
            class="text-white hover:bg-emerald-500 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium">Withdraw</a>

        <a
            href="./transfer"
            class="text-white hover:bg-emerald-500 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium">Transfer</a>
    </div>
    <div class="border-t border-emerald-700 pb-3 pt-4">
        <div class="flex items-center px-5">
            <div class="flex-shrink-0">
                <img class="w-10 h-10 rounded-full" src="<?= $avatarUrl; ?>" alt="<?= $userName; ?>" />
            </div>
            <div class="ml-3">
                <div class="text-base font-medium text-white">
                    <?= $userName; ?>
                </div>
                <div class="text-sm font-medium text-emerald-300">
                    <?= $user['email']; ?>
                </div>
            </div>
            <button
                type="button"
                class="ml-auto flex-shrink-0 rounded-full bg-emerald-600 p-1 text-emerald-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-emerald-600">
                <span class="sr-only">View notifications</span>
                <svg
                    class="h-6 w-6"
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
        <div class="mt-3 space-y-1 px-2">
            <a
                href="/logout"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-emerald-500 hover:bg-opacity-75">Sign out</a>
        </div>
    </div>
</div>