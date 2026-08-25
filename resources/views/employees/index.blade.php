<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Employés</h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow p-6">

        @if (session('success'))
            <div class="mb-4 bg-green-50 text-green-700 text-sm px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('employees.create') }}"
               class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700">
                + Ajouter un employé
            </a>
        </div>

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Rôle</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($employees as $employee)
                <tr>
                    <td class="px-4 py-3">{{ $employee->name }}</td>
                    <td class="px-4 py-3">{{ $employee->email }}</td>
                    <td class="px-4 py-3">{{ $employee->getRoleNames()->first() ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="text-yellow-600 hover:underline">Modifier</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Supprimer cet employé ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>