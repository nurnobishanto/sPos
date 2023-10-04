<?php

namespace App\Http\Resources;

use App\Models\POSRegister;

/**
 * Class POSRegisterCollection
 */
class POSRegisterCollection extends BaseCollection
{
    public $collects = POSRegisterResource::class;
}
