<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <p class="mt-2 text-sm text-gray-600">
                A list of all the customers including their name, email and
                profile picture.
            </p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a
                href="./customers/create"
                type="button"
                class="block px-3 py-2 text-sm font-semibold text-center text-white rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                Add Customer
            </a>
        </div>
    </div>

    <!-- Users List -->
    <div class="flow-root mt-8">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <ul role="list" class="divide-y divide-gray-100">

                <?php foreach ($customers as $customer) {
                    $customerName = $customer['first_name'] . ' ' . $customer['last_name'];
                ?>
                    <li
                        class="relative flex justify-between px-4 py-5 gap-x-6 hover:bg-gray-50 sm:px-6 lg:px-8">
                        <div class="flex gap-x-4">
                            <img
                                class="flex-none w-12 h-12 rounded-full bg-gray-50"
                                src="https://ui-avatars.com/api/?size=256&background=random&name=<?= urlencode($customerName); ?>"
                                alt="<?= htmlspecialchars($customerName); ?>" />

                            <div class="flex-auto min-w-0">
                                <p
                                    class="text-sm font-semibold leading-6 text-gray-900">
                                    <a href="./customer_transactions">
                                        <span
                                            class="absolute inset-x-0 bottom-0 -top-px"></span>
                                        <?= htmlspecialchars($customerName); ?>
                                    </a>
                                </p>
                                <p class="flex mt-1 text-xs leading-5 text-gray-500">
                                    <a
                                        href="./customer_transactions"
                                        class="relative truncate hover:underline">
                                        <?= htmlspecialchars($customer['email']); ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <?php
                        include __DIR__ . '/../partials/customer-status.php';
                        ?>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>