<?php

namespace App\Services;

use App\Models\ExchangeRate;
use Illuminate\Pagination\Paginator;

class Paginate {
    public static function paginate($data, $perPage) {

        // Get pagination information and slice the results.
        $total = count($data);
        $start = (Paginator::getCurrentPage() - 1) * $perPage;
        $sliced = array_slice($data, $start, $perPage);

        // Eager load the relation.
        $collection = ExchangeRate::hydrate($sliced);
        $collection->load('relation');

        // Create a paginator instance.
        return Paginator::make($collection->all(), $total, $perPage);
    }
}
