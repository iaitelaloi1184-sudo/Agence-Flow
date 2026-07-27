<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Clients</h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow p-6">

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('clients.create') }}"
               class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700">
                + Ajouter un client
            </a>

            <div class="relative">
                <input type="text" id="searchInput"
                       placeholder="Rechercher un client..."
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
                <button type="button" id="clearBtn"
                        class="absolute right-2 top-2 text-gray-400 hover:text-gray-700 hidden">
                    ✕
                </button>
            </div>
        </div>

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Téléphone</th>
                    <th class="px-4 py-3">Secteur</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody id="clientsTableBody" class="divide-y divide-gray-100">
                @include('clients._rows')
            </tbody>
        </table>

    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const clearBtn = document.getElementById('clearBtn');
        const tableBody = document.getElementById('clientsTableBody');

        function fetchClients(search = '') {
            fetch(`{{ route('clients.search') }}?search=${encodeURIComponent(search)}`)
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                });
        }

        searchInput.addEventListener('keyup', function () {
            const value = this.value;
            clearBtn.classList.toggle('hidden', value.length === 0);
            fetchClients(value);
        });

        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            clearBtn.classList.add('hidden');
            fetchClients('');
            searchInput.focus();
        });
    </script>
</x-app-layout>