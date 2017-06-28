<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;


class ImageL3Filter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(800, 500);
    }
}