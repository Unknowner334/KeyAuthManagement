<section class="flex flex-col lg:flex-row gap-4 w-full justify-center items-center lg:items-start">
    <div class="w-2/5 sm:w-3/5 md:w-4/5 lg:w-[95%] flex flex-col min-w-0">
        <div class="bg-dark rounded-t-md shadow px-5 py-3 flex justify-between items-center">
            <h1 class="text-lg font-bold text-white mb-0">
                Registrations History (Latest 10)
            </h1>
            <button id="reloadBtn" 
                    class="bg-transparent text-white border border-white hover:border-transparent hover:bg-primary font-semibold px-4 py-2 rounded-lg shadow transition duration-200 flex items-center gap-2">
                <i class="bi bi-arrow-clockwise"></i>
                Refresh
            </button>
        </div>

        <div class="overflow-auto relative scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200 bg-white rounded-b-md shadow-lg p-5">
            <table class="w-full min-w-full divide-y divide-gray-200 " id="licenses_table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-stone-400">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-stone-400">
                            User License
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-stone-400">
                            Duration
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-stone-400">
                            Registrar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-stone-400">
                            Devices
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-stone-400">
                            Created
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="w-1/5 flex flex-col min-w-0">
        <div class="bg-dark rounded-t-md shadow px-5 py-4.75 flex justify-between items-center">
            <h1 class="text-lg font-bold text-white mb-0">
                information
            </h1>
        </div>
        <div class="bg-white rounded-b-md shadow-lg p-5">
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        const license_table = $('#licenses_table').DataTable({
            processing: true,
            responsive: true,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false,
            ordering: false,
            ajax: {
                url: "{{ route('api.private.home.registrations') }}",
                type: 'GET'
            },
            columns: [
                { data: 'id' },
                { data: 'user_key' },
                { data: 'duration' },
                { data: 'registrar' },
                { data: 'devices' },
                { data: 'created' },
            ],
            scrollX: true,
            stripeClasses: [],
            language: {
                processing: `
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                                bg-primary text-white px-4 py-2 rounded font-semibold shadow z-50">
                        Processing...
                    </div>
                `
            }
        });

        $('#reloadBtn').on('click', function () {
            license_table.ajax.reload(null, false);
        });
    });
</script>