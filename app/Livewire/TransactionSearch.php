<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TransactionSearch extends Component
{
    public $address;
    public $transactions = [];
    public $errorMessage;
    public $currentPage = 1;
    public $pageSize = 10; // Número de transacciones por página
    public $totalTransactions = 0;

    public function searchTransactions()
    {
        $this->errorMessage = null; // Reset the error message
        $this->transactions = []; // Reset transactions

        // Validar la dirección Ethereum
        if (!preg_match('/^0x[a-fA-F0-9]{40}$/', $this->address)) {
            $this->errorMessage = 'La dirección Ethereum no es válida.';
            return;
        }

        // Llamada a la API de Etherscan
        $apiKey = env('ETHERSCAN_API_KEY'); // Configura tu clave en .env
        $response = Http::get('https://api.etherscan.io/api', [
            'module' => 'account',
            'action' => 'txlist',
            'address' => $this->address,
            'startblock' => 0,
            'endblock' => 99999999,
            'page' => $this->currentPage,
            'offset' => $this->pageSize,
            'sort' => 'desc', // Transacciones más recientes primero
            'apikey' => $apiKey,
        ]);

        $data = $response->json();

        if ($data['status'] == '1' && isset($data['result'])) {
            $this->transactions = $data['result'];
            $this->totalTransactions = count($data['result']); // Etherscan no devuelve total real en la API gratuita
        } else {
            $this->errorMessage = 'No se pudieron recuperar las transacciones o la dirección no tiene transacciones.';
        }
    }

    public function goToPage($page)
    {
        $this->currentPage = $page;
        $this->searchTransactions();
    }

    public function render()
    {
        return view('livewire.transaction-search');
    }
}
