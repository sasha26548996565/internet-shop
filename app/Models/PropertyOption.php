<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class PropertyOptions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property(): Relation
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
