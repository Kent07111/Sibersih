<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageService
{
    public static function upload(
        UploadedFile $file,
        string $folder = 'uploads',
        int $maxWidth = 1600,
        int $quality = 80
    ): string {

        $manager = new ImageManager(new Driver());

        $image = $manager->read($file);

        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        $filename = Str::uuid() . '.webp';

        $encoded = $image->toWebp($quality);

        Storage::disk('public')->put(
            $folder . '/' . $filename,
            $encoded->toString()
        );

        return $folder . '/' . $filename;
    }

    /**
     * Hapus file lama
     */
    public static function delete(?string $path): void
    {
        if (!$path) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Ganti file lama dengan file baru
     */
    public static function replace(
        UploadedFile $file,
        ?string $oldFile,
        string $folder = 'uploads',
        int $maxWidth = 1600,
        int $quality = 80
    ): string {

        self::delete($oldFile);

        return self::upload(
            $file,
            $folder,
            $maxWidth,
            $quality
        );
    }
}
