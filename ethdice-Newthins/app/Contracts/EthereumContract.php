<?php

namespace App\Contracts;

interface EthereumContract
{
    public function getTransactions(string $address, int $startBlock = null, int $endBlock = null): array;

    public function getBalance(string $address): float;

    public function convertWeiToEth(int $wei): float;
}
