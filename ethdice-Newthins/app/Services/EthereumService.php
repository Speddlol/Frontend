<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Transaction;
use App\Contracts\EthereumContract;
use Exception;
use Web3\Web3;

class EthereumService implements EthereumContract
{
    protected $client;
    protected $infuraUrl;
    protected $etherscanUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->infuraUrl = 'https://dry-frequent-grass.ethereum-goerli.quiknode.pro/';
        $this->etherscanUrl = 'https://api.etherscan.io/api';
        $this->apiKey = 'NMHIJP3N6ACFDC97VK9WWYQ9VWMTRX3WZA';
    }

    public function getTransactions(string $address, int $startBlock = null, int $endBlock = null): array
    {
        $web3 = new Web3($this->infuraUrl);

        $transactions = $web3->eth->getTransactionByAddress($address, [
            'fromBlock' => $startBlock,
            'toBlock' => $endBlock,
        ]);

        $result = [];
        foreach ($transactions as $tx) {
            if ($tx->status == 1) {
                $result[] = new Transaction([
                    'hash' => $tx->hash,
                    'blockNumber' => $tx->blockNumber,
                    'from' => $tx->from,
                    'to' => $tx->to,
                    'value' => $tx->value,
                ]);
            }
        }

        return $result;
    }

    public function getBalance(string $address): float
    {
        $web3 = new Web3($this->infuraUrl);
        $balance = $web3->eth->getBalance($address);
        return (float) $balance->toString();
    }

    public function convertWeiToEth(int $wei): float
    {
        return $wei / pow(10, 18);
    }
}
