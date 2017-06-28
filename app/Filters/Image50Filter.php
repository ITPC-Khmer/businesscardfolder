<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;


class Image50Filter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(50, 50);
    }
}