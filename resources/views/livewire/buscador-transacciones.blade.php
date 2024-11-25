<div>
    <!-- Formulario para ingresar la dirección de la billetera -->
    <form wire:submit.prevent="buscarTransacciones">
        <input type="text" wire:model="direccion" placeholder="Ingresa la dirección Ethereum">
        <button type="submit">Buscar</button>
    </form>

    <!-- Mostrar mensaje de error si ocurre -->
    @if (session()->has('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <!-- Mostrar tabla de transacciones -->
    @if(!empty($transacciones))
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Intercambio</th>
                    <th>Protocolo</th>
                    <th>Transacción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transacciones as $transaccion)
                    <tr>
                        <td>{{ $transaccion['fecha'] }}</td>
                        <td>{{ isset($transaccion['intercambio']) ? $transaccion['intercambio'] : 'No disponible' }}</td>
                        <td>{{ isset($transaccion['protocolo']) ? $transaccion['protocolo'] : 'No disponible' }}</td>
                        <td>{{ isset($transaccion['hash']) ? $transaccion['hash'] : 'No disponible' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No se encontraron transacciones para esta dirección.</p>
    @endif
</div>
