<?php

namespace App\Services\File;


use App\Models\Admin\File;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    public function uploadImages($productId, $request)
    {
        try {
            $files = $request->file("file");

            if (!is_array($files)) {
                throw new \Exception('No files uploaded');
            }

            $uploadedFiles = [];

            foreach ($files as $file) {
                $pathToImage = Storage::putFile(
                    'public/products/' . $productId . '/photos/original',
                    $file
                );

                $fileImg = new File();
                $fileImg->name = last(explode("/", $pathToImage));
                $fileImg->mime_type = $file->getClientMimeType();
                $fileImg->type = File::TYPE_IMG;
                $fileImg->path = $pathToImage;
                $fileImg->save();

                $uploadedFiles[] = $fileImg->id;
            }

            return [
                'status' => true,
                "message" => '',
                "data" => [
                    'file_ids' => $uploadedFiles
                ]
            ];

        } catch (\Exception $exception) {
            return [
                'status' => false,
                "message" => $exception->getMessage(),
                "data" => []
            ];
        }
    }

    public function uploadImage($request)
    {
        $file = $request->file("file_id");

        $pathToImage = Storage::putFile(
            'public/photos/original',
            $file
        );

        $fileImg = new File();
        $fileImg->name = last(explode("/", $pathToImage));
        $fileImg->mime_type = $file->getClientMimeType();
        $fileImg->type = File::TYPE_IMG;
        $fileImg->path = $pathToImage;
        $fileImg->save();

        return [
            'status' => true,
            "message" => '',
            "data" => [
                'file_id' => $fileImg->id
            ]
        ];
    }

    public function delete($fileId)
    {
        $file = File::find($fileId);

        if (empty($file)) {
            return [
                "status" => false,
                "message" => "File is not exist!",
                "file" => []
            ];
        }

        unlink(storage_path("app/" . $file->path));

        $file->delete();

        return [
            "status" => true,
            "message" => "success",
            "file" => []
        ];
    }
}