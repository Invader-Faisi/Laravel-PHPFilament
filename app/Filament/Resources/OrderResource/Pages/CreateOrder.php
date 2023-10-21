<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function afterCreate(): void
    {
        $order = $this->record;
        if ($order) {
            $totalPrice = $order->items()->sum(DB::raw('quantity * unit_price'));
            $order->update(['total_price' => $totalPrice]);
        }
    }
}
