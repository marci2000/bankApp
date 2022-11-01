<?php

namespace App\Repository;

interface BankRepository {
    public function saveDayRates();

    public function saveAllRates();
}
