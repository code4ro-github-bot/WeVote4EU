<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('newsfeed', fn () => true);
Broadcast::channel('stats', fn () => true);
