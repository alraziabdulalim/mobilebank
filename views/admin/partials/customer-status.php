<!-- Status Line START -->
<?php if (htmlspecialchars($customer['auth_permit'] ?? '') != '') { ?>
    <span class="inline-flex items-center justify-center h-6 rounded-md bg-green-500 px-3">
        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="ml-2 text-sm font-medium leading-none text-white">Approved</span>
    </span>
<?php } else { ?>
    <span class="inline-flex items-center justify-center h-6 rounded-md bg-orange-500 px-3">
        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 110 20 10 10 0 010-20z" />
        </svg>
        <span class="ml-2 text-sm font-medium leading-none text-white">Approval Pending</span>
    </span>
<?php } ?>
<!-- Status Line END -->

<!-- Approval Line START -->
<?php if (htmlspecialchars($customer['auth_permit'] ?? '') == '') { ?>
    <form method="POST" action="/admin/customers-update">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($customer['id']) ?>">

        <button type="submit" name="auth_permit" value="is_Permit"
            class="inline-flex items-center justify-center h-6 rounded-md bg-yellow-500 px-3">
            <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="ml-2 text-sm font-medium leading-none text-white">Approve</span>
        </button>

        <button type="submit" name="auth_permit" value="cancel"
            class="inline-flex items-center justify-center h-6 rounded-md bg-red-500 px-3">
            <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="ml-2 text-sm font-medium leading-none text-white">Cancel</span>
        </button>
    </form>
<?php } ?>
<!-- Approval Line END -->