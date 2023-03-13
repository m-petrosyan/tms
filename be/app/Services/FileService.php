<?php

namespace App\Services;

use App\Helpers\General;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class FileService
{
    /**
     * @param $model
     * @param $field
     * @param $path
     * @return void
     */
    public function checkChangeFile($model, $field, $path): void
    {
        if ($model->isDirty($field) && gettype($model[$field]) !== 'string') {
            if ($model->getOriginal($field)) {
                General::deleteFile($model->getOriginal($field), $path);
            }
            $this->fileCheckUpload($model, $model[$field], $field, $path);
        }
    }

    /**
     * @param $model
     * @param $request
     * @param $field
     * @param $path
     * @return void
     */
    public function fileCheckUpload($model, $request, $field, $path): void
    {
        if (isset($request)) {
            $this->updateImg($model, $request, $field, $path);
        }
    }

    /**
     * @param  object  $model
     * @param $img
     * @param  string  $field
     * @param  string  $path
     * @return void
     */
    public function updateImg(object $model, $img, string $field, string $path): void
    {
        $fileName = $this->uploadMedia($img, '/'.$path)['name'];
        $model->update([$field => $fileName]);
    }

    public const IMAGE_MIME_TYPES = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg+xml'];

    /**
     * @param  UploadedFile  $file
     * @param $folder
     * @param  string  $disk
     * @return array
     */
    public function uploadMedia(UploadedFile $file, $folder, string $disk = 'public'): array
    {
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
