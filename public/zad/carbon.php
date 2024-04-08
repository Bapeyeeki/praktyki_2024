<?php

require __DIR__ . '/../../vendor/autoload.php';

printf("Right now is %s", \Carbon\Carbon::now()->toDateTimeString());