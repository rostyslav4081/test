<?php

namespace App\Services;

use App\Models\PohodaStock;

class PohodaService
{
    public function searchStock(string $term)
    {
        return PohodaStock::where('NAME', 'LIKE', "%{$term}%")
            ->limit(20)
            ->get();
    }
}
