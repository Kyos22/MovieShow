<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileUploadService {


    public function uploadFileImage(UploadedFile $file, string $path):string{
        $fileName = time() . '_' . $file->getClientOriginalName();
        $targetPath = public_path($path);
        $file->move($targetPath,$fileName);
        return $path .'/' .$fileName;
    }
    public function uploadFileVideo(UploadedFile $file, string $path):string{
        $fileName = time() . '_' . $file->getClientOriginalName();
        $targetPath = public_path($path);
        $file->move($targetPath,$fileName);
        return $path .'/' .$fileName;
    }
}

?>