<form action="customers-store" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
    <div class="px-4 py-6 sm:p-8">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First Name</label>
                <div class="mt-2">
                    <input type="text" name="first_name" id="first-name" autocomplete="given-name"
                      value="<?= isset($request['first_name']) ? $request['first_name'] : ''; ?>" required="" class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                    <div class="text-red-400">
                      <?= isset($errors['first_name']) ? $errors['first_name'] : ''; ?>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last Name</label>
                <div class="mt-2">
                    <input type="text" name="last_name" id="last-name" autocomplete="family-name"
                      value="<?= isset($request['last_name']) ? $request['last_name'] : ''; ?>" required="" class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                    <div class="text-red-400">
                      <?= isset($errors['last_name']) ? $errors['last_name'] : ''; ?>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" autocomplete="email"
                      value="<?= isset($request['email']) ? $request['email'] : ''; ?>" required="" class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                    <div class="text-red-400">
                      <?= isset($errors['email']) ? $errors['email'] : ''; ?>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="password" required="" class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                    <div class="text-red-400">
                      <?= isset($errors['password']) ? $errors['password'] : ''; ?>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-3">
                  <label for="auth_permit" class="block text-sm font-medium leading-6 text-gray-900">Approval
                    Action</label>
                  <div class="mt-2">
                    <input type="checkbox" name="auth_permit" id="auth_permit" value="is_Permit"
                      <?= isset($request['auth_permit']) && $request['auth_permit'] ? 'checked' : ''; ?>
                      class="h-4 w-4 text-sky-600 border-gray-300 rounded focus:ring-sky-600" />
                    <label for="auth_permit" class="ml-2 text-sm text-gray-900">Is Permit</label>
                    <div class="text-red-400">
                      <?= isset($errors['auth_permit']) ? $errors['auth_permit'] : ''; ?>
                    </div>
                  </div>
                </div>
        </div>
    </div>
    <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
        <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">
            Cancel
        </button>
        <button type="submit" class="px-3 py-2 text-sm font-semibold text-white rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
            Create Customer
        </button>
    </div>
</form>