<?php

namespace App\Models\Console\Files;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Akip extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function uniqueIds()
    {
        return ['uuid'];
    }
}
