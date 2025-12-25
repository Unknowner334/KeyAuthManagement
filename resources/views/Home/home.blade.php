<section class="flex flex-col lg:flex-row gap-4 w-full justify-center items-center lg:items-start flex-wrap">
    <div class="w-2/5 sm:w-3/5 md:w-4/5 flex flex-col min-w-0">
        <div class="bg-dark rounded-t-md shadow px-5 pt-5 pb-2">
            <h1 class="text-1xl font-semibold text-white mb-6 text-center">
                Registrations History
            </h1>
        </div>

        <div class="overflow-auto bg-white rounded-b-md shadow-lg p-5">
            <table class="w-full table-auto min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">1</td>
                        <td class="px-6 py-4 whitespace-nowrap">Admin</td>
                        <td class="px-6 py-4 whitespace-nowrap">admin@example.com</td>
                        <td class="px-6 py-4 whitespace-nowrap">Owner</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">2</td>
                        <td class="px-6 py-4 whitespace-nowrap">User</td>
                        <td class="px-6 py-4 whitespace-nowrap">user@example.com</td>
                        <td class="px-6 py-4 whitespace-nowrap">Member</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="w-1/5 flex flex-col min-w-0">
        <div class="bg-dark rounded-t-md shadow px-5 pt-5 pb-2">
            <h1 class="text-1xl font-semibold text-white mb-6 text-center">Information</h1>
        </div>
        <div class="bg-white rounded-b-md shadow-lg p-5">
        </div>
    </div>
</section>