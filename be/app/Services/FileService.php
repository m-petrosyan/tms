<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class FileService
{
    public const IMAGE_MIME_TYPES = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg+xml'];

    /**
     * @param  UploadedFile  $file
     * @param $folder
     * @param $oldFile
     * @param  string  $disk
     * @return array
     */
    public function uploadMedia(UploadedFile $file, $folder, $oldFile = null, string $disk = 'public'): array
    {
        if ($oldFile) {
            $this->deleteMedia($oldFile, $folder);
        }

        $fileName = time().Str::random(5).'.'.$file->getClientOriginalExtension();

        //Upload File
        $src = $file->storeAs($folder, $fileName, $disk);

        return [
            'src' => $src,
            'name' => $fileName,
            'mime' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
        ];
    }

    /**
     * @param $oldFile
     * @param  string  $path
     * @param  string  $disk
     * @return void
     */
    public function deleteMedia($oldFile, string $path, string $disk = 'public'): void
    {
        Storage::disk($disk)->delete($path.'/'.$oldFile);
    }
}
