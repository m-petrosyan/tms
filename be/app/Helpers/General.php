<?php
namespace App\Helpers;

use App\Services\FileService;
use Illuminate\Support\Facades\Storage;

class General extends FileService {

    public static function deleteFile(string $file, string $path)
    {
        (new General)->deleteMedia($file, $path);
    }

    public static function getPath($fileName, string $disk = '', string $assetsPath = 'storage/'): string
    {
        if (! $fileName) {
            return '';
        }

        if (filter_var($fileName, FILTER_VALIDATE_URL) !== false) {
            return $fileName;
        }

        $disk = $disk ?: config('filesystems.default');

        return $disk && Storage::disk($disk)->exists($fileName) ? Storage::disk($disk)->url($fileName) : asset($assetsPath.$fileName);
    }
}
