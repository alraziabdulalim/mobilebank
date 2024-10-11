<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <p class="mt-2 text-sm text-gray-700">
                List of transactions made by <?= htmlspecialchars($accountLedger['customerId']); ?>.
            </p>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                Receiver Name
                            </th>
                            <th scope="col"
                                class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                Email
                            </th>
                            <th scope="col"
                                class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Amount
                            </th>
                            <th scope="col"
                                class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <!-- TRANSACTION START -->
                        <?php foreach ($accountLedger['transactions'] as $transaction) { ?>
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-800 sm:pl-0">
                                    <?= htmlspecialchars($transaction['user_id']); ?>
                                </td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                                    <?= htmlspecialchars($transaction['pay_to']); ?>
                                </td>
                                <?php if (($transaction['trans_type']) == 'deposit') { ?>
                                    <td class="whitespace-nowrap px-2 py-4 text-sm font-medium text-emerald-600">
                                        <?= '+$' . htmlspecialchars($transaction['amount']); ?>
                                    </td>
                                <?php } else { ?>
                                    <td class="whitespace-nowrap px-2 py-4 text-sm font-medium text-red-600">
                                        <?= '-$' . htmlspecialchars($transaction['amount']); ?>
                                    </td>
                                <?php } ?>
                                <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                                    <?= htmlspecialchars($transaction['created_at']); ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <!-- TRANSACTION END -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>