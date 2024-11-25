<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class BuscadorTransacciones extends Component
{
    public $direccion; // Dirección Ethereum para buscar
    public $transacciones = []; // Array para almacenar las transacciones

    // Método para buscar las transacciones
    public function buscarTransacciones()
    {
        $this->validate([
            'direccion' => 'required|regex:/^0x[a-fA-F0-9]{40}$/', // Validar formato de dirección
        ]);

        // Llamada a la API de Etherscan
        $response = Http::get('https://api.etherscan.io/api', [
            'module' => 'account',
            'action' => 'txlist',
            'address' => $this->direccion,
            'startblock' => 0,
            'endblock' => 99999999,
            'page' => 1,
            'offset' => 10,
            'sort' => 'asc',
            'apikey' => env('ETHERSCAN_API_KEY'), // Clave de API en .env
        ]);

        // Verificar si la respuesta fue exitosa y si contiene datos
        if ($response->successful()) {
            $data = $response->json();

            // Verificar que la clave 'result' esté presente y sea un array
            if (isset($data['result']) && is_array($data['result'])) {
                // Obtener las transacciones
                $transacciones = $data['result'];

                // Convertir el timestamp en una fecha legible
                foreach ($transacciones as &$transaccion) {
                    if (isset($transaccion['timeStamp'])) {
                        // Convertir el timestamp (que está en formato UNIX) a una fecha legible
                        $transaccion['fecha'] = date('d/m/Y, H:i:s', $transaccion['timeStamp']);
                    } else {
                        $transaccion['fecha'] = 'Fecha no disponible';
                    }
                }

                // Asignar las transacciones al atributo de la clase
                $this->transacciones = $transacciones;
            } else {
                session()->flash('error', 'No se encontraron transacciones o la respuesta de la API es incorrecta.');
            }
        } else {
            $this->transacciones = [];
            session()->flash('error', 'Error al obtener las transacciones de la API.');
        }
    }

    public function render()
    {
        return view('livewire.buscador-transacciones');
    }
}
