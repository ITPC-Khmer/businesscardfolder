<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;


class ImageL2Filter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(400, 400);
    }
}