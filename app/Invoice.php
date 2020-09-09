<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    const SENT = 0;
    const NOSENT = 1;
    const REJECTED = 2;
    const OBSERVED = 3;
    const APPROVED = 4;
}
