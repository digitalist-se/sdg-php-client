<?php

namespace SdgScoped;

// Don't redefine the functions if included multiple times.
if (!\function_exists('SdgScoped\\GuzzleHttp\\Promise\\promise_for')) {
    require __DIR__ . '/functions.php';
}
