<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\ImageManager;

class ImageOptimizer
{
    private $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(['driver' => 'gd']);
    }

    public function resize(string $path, int $width, int $height)
    {
        $image = $this->imageManager->make($path);
        $image->fit($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        
        $image->save($path, 80);
    }
} 