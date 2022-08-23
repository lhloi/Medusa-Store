<?php

namespace App\Traits;
use Storage;

trait StorageImageTrait{
    public function storageTraitUpload($request, $fieldName, $foderName)
    {
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = rand(0,9999).'.'.$fileNameOrigin;
            $filePath = $request->file($fieldName)->storeAs('public/'.$foderName,$fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }
        return null;
    }
    public function storageTraitUploadMutiple($file, $foderName)
    {

        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = rand(0,9999).'.'.$fileNameOrigin;
        $filePath = $file->storeAs('public/'.$foderName, $fileNameHash);
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $dataUploadTrait;

    }
}
