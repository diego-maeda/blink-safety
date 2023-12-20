<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\PoliceDepartmentChannel;

Broadcast::channel('police-department.{zipcode}', PoliceDepartmentChannel::class);
