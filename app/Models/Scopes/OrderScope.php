<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrderScope implements Scope
{
    protected string $order_column;
    protected string $order_direction;
    public function __construct($order_column='order_col',$order_direction="asc")
    {
        $this->order_column = $order_column;
        $this->order_direction = $order_direction;
    }
    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderBy($this->order_column,$this->order_direction);
    }
}
