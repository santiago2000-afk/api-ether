<div class="container mx-auto px-6 py-8">
    <!-- Formulario de búsqueda -->
    <div class="form-container bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
        <form wire:submit.prevent="searchTransactions" class="space-y-6">
            <div class="space-y-4">
                <label for="address" class="text-lg font-medium text-gray-700">Ethereum Address</label>
                <input 
                    type="text" 
                    id="address" 
                    wire:model="address" 
                    placeholder="0x..."
                    oninput="toggleTableVisibility()"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Search
                </button>
            </div>
            @error('address') 
                <span class="text-red-400 text-xs">{{ $message }}</span> 
            @enderror
        </form>
    </div>

    @if ($address)
    <div class="mt-4 text-sm text-gray-600">
        <label class="font-medium text-lg text-gray-800">Wallet Selected</label>
        <div class="flex items-center">
            <span class="font-semibold text-blue-600 break-words" id="wallet-address">{{ $address }}</span>
            <button 
                type="button" 
                class="ml-3 text-blue-500 hover:text-blue-700 font-semibold"
                onclick="copyToClipboard()"
                aria-label="Copy to clipboard"
            >
                <i class="fas fa-copy" title="Copy address"></i>
            </button>
        </div>
    </div>
    @endif

    
    <!-- Cargando o resultados -->
    <div id="loader" class="loader" style="display: none;">
        <div class="spinner"></div>
    </div>

    @if ($errorMessage)
        <div class="mt-6 text-red-400 text-sm">
            {{ $errorMessage }}
        </div>
    @elseif ($transactions && count($transactions) > 0)
        <div class="table-container mt-8" id="transactions-container">
            <table id="transactions-table" class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="text-left text-sm font-medium text-gray-700 bg-gray-100">
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Swap</th>
                        <th class="px-4 py-2">Protocol</th>
                        <th class="px-4 py-2">Transaction</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::createFromTimestamp($transaction['timeStamp'])->toDateTimeString() }}</td>
                            <td class="px-4 py-2">{{ $transaction['input'] ? substr($transaction['input'], 0, 10) . '...' : 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $transaction['to'] }}</td>
                            <td class="px-4 py-2">
                                <a href="https://etherscan.io/tx/{{ $transaction['hash'] }}" target="_blank" class="text-blue-500 hover:text-blue-700">View TX</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div id="pagination-controls" class="mt-6">
                <!-- Los controles de DataTable se generarán aquí automáticamente -->
            </div>
        </div>
    @endif
</div>

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
        loader.style.display = show ? 'flex' : 'none';
    }

    // Inicializar DataTable con paginación, scroll infinito y más de 50 registros por página
    document.addEventListener('DOMContentLoaded', function() {
        const table = $('#transactions-table').DataTable({
            paging: true, // Habilitar paginación
            searching: false, // Deshabilitar la búsqueda
            ordering: true, // Permitir ordenamiento
            responsive: true, // Hacer la tabla adaptable
            lengthChange: true, // Permitir cambiar la cantidad de registros por página
            pageLength: 50, // Número de registros por página (cambiado a 50)
            language: {
                emptyTable: "No transactions found.",
                paginate: {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                }
            },
            dom: 'lfrtip', // Esto asegura que la tabla incluya la paginación
            scrollY: '400px', // Altura fija para habilitar el scroll
            scrollCollapse: true, // Colapsar la tabla si no hay suficientes registros
            scroller: true, // Permitir scroll infinito
            fixedHeader: true, // Fijar la cabecera de la tabla al hacer scroll
        });

        // El contenedor de la paginación se generará automáticamente dentro de DataTable
        // No es necesario agregarlo manualmente
    });

    // Mostrar el loader cuando el formulario se envíe
    document.querySelector('form').addEventListener('submit', function() {
        toggleLoader(true); // Mostrar el loader
    });

    // Ocultar el loader cuando los datos estén listos
    document.querySelector('.table-container').addEventListener('load', function() {
        toggleLoader(false); // Ocultar el loader
    });

    // Función para copiar la dirección al portapapeles
    function copyToClipboard() {
        const walletAddress = document.getElementById('wallet-address').textContent; // Obtener el texto de la dirección
        const textarea = document.createElement('textarea'); // Crear un elemento de texto oculto
        textarea.value = walletAddress; // Asignar el valor al textarea
        document.body.appendChild(textarea); // Agregarlo al body
        textarea.select(); // Seleccionar el contenido
        document.execCommand('copy'); // Ejecutar el comando de copiar
        document.body.removeChild(textarea); // Eliminar el textarea

        alert('Address copied to clipboard!'); // Mostrar un mensaje de éxito (opcional)
    }
</script>
