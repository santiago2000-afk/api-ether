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
    public $pageSize = 50; // Número de transacciones por página
    public $totalTransactions = 0;
    public $balance; // Para almacenar el saldo de la dirección

    public function searchTransactions()
    {
        $this->errorMessage = null; // Resetear el mensaje de error
        $this->transactions = []; // Resetear las transacciones
    
        // Validar la dirección Ethereum
        if (!preg_match('/^0x[a-fA-F0-9]{40}$/', $this->address)) {
            $this->errorMessage = 'La dirección Ethereum no es válida.';
            return;
        }
    
        // Llamada a la API de Etherscan para obtener transacciones
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
    
        // Verifica si la respuesta es exitosa y contiene el campo 'result'
        $data = $response->json();
    
        // Inspeccionar la respuesta
        if ($data['status'] != '1') {
            // Si el estado no es 1, logueamos el error para depurar
            $this->errorMessage = 'Error al obtener las transacciones: ' . $data['message'];
            \Log::error('Etherscan API Error:', $data); // Log de error
        } else {
            if (isset($data['result']) && !empty($data['result'])) {
                $this->transactions = $data['result'];
                $this->totalTransactions = count($data['result']); // Etherscan no devuelve el total real en la API gratuita
            } else {
                // Si no hay transacciones, mostrar mensaje específico
                $this->errorMessage = 'La dirección no tiene transacciones.';
            }
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
