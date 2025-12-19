        $(document).ready(function() {
            const table = $('#datatable').DataTable({
                processing: true,
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                ordering: false,
                ajax: {
                    url: '{{ route('dashboard.data') }}',
                    type: 'GET',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },
                    { data: 'user_key' },
                    { data: 'duration' },
                    { data: 'registrar' },
                    { data: 'devices' },
                    { data: 'created' },
                ],
            });

            $('#reloadBtn').on('click', function () {
                table.ajax.reload(null, false);
            });
        });

        function updateLoginTime() {
            const timerElem = document.getElementById('login-timer');
            const loginTimeStr = timerElem.getAttribute('data-logintime');

            if (!loginTimeStr) {
                timerElem.textContent = 'never logged in';
                return 60000;
            }

            const loginTime = new Date(loginTimeStr).getTime();
            if (isNaN(loginTime)) {
                timerElem.textContent = 'invalid date';
                return 60000;
            }

            const now = Date.now();
            const diff = Math.floor((now - loginTime) / 1000);

            let display = '';
            if (diff < 60) {
                display = diff + ' seconds ago';
            } else if (diff < 3600) {
                const minutes = Math.floor(diff / 60);
                display = `${minutes} minutes ago`;
            } else if (diff < 86400) {
                const hours = Math.floor(diff / 3600);
                display = `${hours} hours ago`;
            } else {
                const days = Math.floor(diff / 86400);
                display = `${days} days ago`;
            }

            timerElem.textContent = display;

            if (diff < 60) return 1000;
            else if (diff < 3600) return 30000;
            else return 300000;
        }

        function updateExpiryTime() {
            const expiryElem = document.getElementById('expiry-timer');
            const expiryStr = expiryElem.getAttribute('data-expiry');

            if (!expiryStr) {
                expiryElem.textContent = 'no expiry';
                return 60000;
            }

            const expiryTime = new Date(expiryStr).getTime();
            if (isNaN(expiryTime)) {
                expiryElem.textContent = 'invalid expiry';
                return 60000;
            }

            const now = Date.now();
            let diff = Math.floor((expiryTime - now) / 1000);

            if (diff <= 0) {
                expiryElem.textContent = 'expired';
                return 60000;
            }

            let display = '';
            if (diff < 60) {
                display = `in ${diff} seconds`;
            } else if (diff < 3600) {
                const minutes = Math.floor(diff / 60);
                display = `in ${minutes} minutes`;
            } else if (diff < 86400) {
                const hours = Math.floor(diff / 3600);
                display = `in ${hours} hours`;
            } else {
                const days = Math.floor(diff / 86400);
                display = `in ${days} days`;
            }

            expiryElem.textContent = display;

            if (diff < 60) return 1000;
            else if (diff < 3600) return 30000;
            else return 300000;
        }

        function startExpiryTimer() {
            const interval = updateExpiryTime();
            setTimeout(startExpiryTimer, interval);
        }

        function startLoginTimer() {
            const interval = updateLoginTime();
            setTimeout(startLoginTimer, interval);
        }

        startExpiryTimer();
        startLoginTimer();