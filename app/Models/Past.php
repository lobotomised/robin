<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property string encrypted
 * @property $this expire_at
 */
class Past extends Model
{

    use UsesUuid;

    protected $fillable = [
        'encrypted',
        'expire_at'
    ];

    protected $casts = [
        'expire_at' => 'datetime'
    ];

    protected $hidden = [
        'encrypted'
    ];

}
