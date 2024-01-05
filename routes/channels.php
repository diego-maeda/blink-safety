<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\PoliceDepartmentChannel;

/**
 * This route is used if we need to authorize access to a specific PD in the future.
 */
Broadcast::channel('police-department.{zipcode}', PoliceDepartmentChannel::class);
