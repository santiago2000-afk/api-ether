<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TransactionSearch extends Component
{
    public $address;
    public $transactions = [];
    public $errorMessage;

    public function searchTransactions()
    {
        $this->errorMessage = null; // Reset the error message
        $this->transactions = []; // Reset transactions

        // Validamos la dirección Ethereum
        if (!filter_var($this->address, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^0x[a-fA-F0-9]{40}$/"]])) {
            $this->errorMessage = 'La dirección Ethereum no es válida.';
            return;
        }

        // Hacemos la solicitud a la API de Etherscan
        $apiKey = env('ETHERSCAN_API_KEY'); // Asegúrate de tener tu clave API configurada en .env
        $response = Http::get('https://api.etherscan.io/v2/api', [
            'chainid' => 1,
            'module' => 'account',
            'action' => 'txlist',
            'address' => $this->address,
            'startblock' => 0,
            'endblock' => 99999999,
            'page' => 1,
            'offset' => 10,
            'sort' => 'desc', // Para obtener las transacciones más recientes
            'apikey' => $apiKey,
        ]);

        $data = $response->json();

        if ($data['status'] == '1' && isset($data['result'])) {
            $this->transactions = $data['result'];
        } else {
            $this->errorMessage = 'No se pudieron recuperar las transacciones o la dirección no tiene transacciones.';
        }
    }

    public function render()
    {
        return view('livewire.transaction-search');
    }
}
