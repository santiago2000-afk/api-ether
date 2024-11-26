<div class="max-w-3xl mx-auto mt-10 p-6 bg-white text-black shadow-md rounded-lg mt-5">
    <!-- Search Form -->
    <form wire:submit.prevent="searchTransactions" class="space-y-6">
        <div class="space-y-4">
            <label for="address" class="block text-sm font-medium text-gray-700">
                Ethereum Address
            </label>
            <div class="flex items-center border border-gray-300 rounded-md overflow-hidden">
                <input 
                    type="text" 
                    id="address" 
                    wire:model="address" 
                    class="flex-1 p-3 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="0x..."
                    oninput="toggleTableVisibility()"
                />
                <button 
                    type="submit" 
                    class="px-4 py-3 bg-blue-500 text-white font-medium hover:bg-blue-600 focus:outline-none transition-all">
                    Search
                </button>
            </div>
            @error('address') 
                <span class="text-red-400 text-xs">{{ $message }}</span> 
            @enderror
        </div>
    </form>

    <!-- Loader -->
    <div id="loader" class="hidden absolute inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="w-16 h-16 border-4 border-t-4 border-blue-500 rounded-full animate-spin"></div>
    </div>

    <!-- Error or Results -->
    @if ($errorMessage)
        <div class="mt-6 text-red-400 text-sm">
            {{ $errorMessage }}
        </div>
    @elseif ($transactions)
        <div id="transactions-container" class="mt-8">
            <!-- Results Table -->
            <table id="transactions-table" class="w-full border-collapse bg-white text-sm shadow-md rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-gray-600">Date</th>
                        <th class="px-4 py-2 text-gray-600">Swap</th>
                        <th class="px-4 py-2 text-gray-600">Protocol</th>
                        <th class="px-4 py-2 text-gray-600">Transaction</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td class="px-4 py-3 text-gray-600">
                                {{ \Carbon\Carbon::createFromTimestamp($transaction['timeStamp'])->toDateTimeString() }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $transaction['input'] ? substr($transaction['input'], 0, 10) . '...' : 'N/A' }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $transaction['to'] }}
                            </td>
                            <td class="px-4 py-3">
                                <a href="https://etherscan.io/tx/{{ $transaction['hash'] }}" 
                                   target="_blank" 
                                   class="text-blue-500 hover:underline">
                                    View TX
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- DataTable Pagination -->
            <div id="pagination-container" class="mt-6 flex justify-between items-center text-sm text-gray-600">
                <span id="page-info">Showing {{ count($transactions) }} entries</span>
                <div id="pagination-controls" class="flex space-x-4">
                    <!-- Pagination will be handled by DataTables -->
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Script for DataTables and Loader control -->
<script>
    // Función para mostrar u ocultar la tabla en función del contenido del input
    function toggleTableVisibility() {
        const input = document.getElementById('address').value.trim();
        const tableContainer = document.getElementById('transactions-container');
        tableContainer.style.display = input === '' ? 'none' : 'block';
    }

    // Función para mostrar y ocultar el loader
    function toggleLoader(show) {
        const loader = document.getElementById('loader');
        loader.classList.toggle('hidden', !show);
    }

    // Inicializar DataTable
    document.addEventListener('DOMContentLoaded', function() {
        const table = $('#transactions-table').DataTable({
            paging: true,
            searching: false,
            ordering: true,
            responsive: true,
            lengthChange: false,
            pageLength: 5,  // Definir cuántas filas por página
            language: {
                emptyTable: "No transactions found.",
                paginate: {
                    previous: "Prev",
                    next: "Next"
                }
            }
        });

        // Actualizar información de la página actual
        table.on('draw', function() {
            const info = table.page.info();
            document.getElementById('page-info').innerText = `Showing ${info.start + 1} to ${info.end} of ${info.recordsTotal} entries`;
        });
    });

    // Mostrar el loader cuando el formulario se envíe
    document.querySelector('form').addEventListener('submit', function() {
        toggleLoader(true);
    });
</script>
