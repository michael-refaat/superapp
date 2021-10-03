<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    
    /**
     * Get the (shipping) rate associated with the item.
     */
    public function rate()
    {
        return $this->hasOne(Rate::class, 'country', 'country');
    }
}
