<?php

namespace SdgScoped;

// Register chunk filter if not found
if (!\array_key_exists('chunk', \stream_get_filters())) {
    \stream_filter_register('chunk', 'SdgScoped\\Http\\Message\\Encoding\\Filter\\Chunk');
}
