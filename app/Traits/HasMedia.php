<?php

namespace App\Traits;

use App\Models\Media;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait HasMedia{

    /**
     * @return MorphMany
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    /**
     * @return mixed
     */
    public function getMedia(): mixed
    {
        return $this->media;
    }

    /**
     * @param $file
     * @param $filename
     * @throws Exception
     */
    public function saveMedia($file, $filename = null)
    {
        DB::beginTransaction();

        try{
            $filename ? Storage::putFileAs('files', $file, $filename) : Storage::putFile('files', $file);

            $media = new Media();
            $media->name = $file->getClientOriginalName();
            $media->disk = 'local';
            $media->extension = $file->extension();

            $this->media()->save($media);

            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

}
