<div class="max-w-4xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <!-- Formulario de búsqueda -->
    <form wire:submit.prevent="searchTransactions" class="space-y-6">
        <div class="relative mt-6">
            <label for="address" class="block text-lg font-medium text-gray-700">
                Buscar dirección Ethereum
            </label>
            <div class="relative mt-2">
                <input 
                    type="text" 
                    id="address" 
                    wire:model="address" 
                    class="peer h-12 w-full pl-14 pr-4 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none placeholder-transparent" 
                    placeholder="0x...">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                    <i class="material-icons">search</i>
                </span>
                <label for="address" class="absolute left-14 top-3 text-gray-500 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base peer-focus:top-1 peer-focus:text-blue-500 peer-focus:text-sm">
                    Dirección Ethereum
                </label>
            </div>
            @error('address') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>
        <button 
            type="submit" 
            class="w-full px-4 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
            Buscar Transacciones
        </button>
    </form>

    <!-- Mensajes de error o resultados -->
    @if ($errorMessage)
        <div class="mt-6 text-red-500 font-medium">
            {{ $errorMessage }}
        </div>
    @elseif ($transactions)
        <div class="mt-8 overflow-x-auto">
            <!-- Tabla de resultados -->
            <table id="transactions-table" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-blue-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">Fecha</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Swap</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Protocolo</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Transacción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::createFromTimestamp($transaction['timeStamp'])->toDateTimeString() }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $transaction['input'] ? substr($transaction['input'], 0, 10) . '...' : 'No disponible' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $transaction['to'] }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="https://etherscan.io/tx/{{ $transaction['hash'] }}" 
                                   target="_blank" 
                                   class="text-blue-500 hover:underline">
                                    Ver TX
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Script para inicializar DataTables -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#transactions-table').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            responsive: true,
            lengthChange: true,
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                paginate: { next: "Siguiente", previous: "Anterior" },
                zeroRecords: "No se encontraron resultados",
            }
        });
    });
</script>
