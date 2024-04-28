<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\File;
use App\Models\Admin\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FileController extends Controller
{
    public function index($fileId)
    {
        $cacheKey = 'file_v2_' . $fileId;

        if (Cache::has($cacheKey)) {
            $file = Cache::get($cacheKey);
        } else {
            $file = File::find($fileId);

            if (empty($file)) {
                return response()->file(storage_path("app/public/images/default_image.jpg"), array(
                    'Content-Type' => 'image/jpeg'
                ));
            }

            Cache::put($cacheKey, $file, 86400);
        }

        return response()->file(storage_path("app/" . $file->path), array('Content-Type' => $file->mime_type));
    }

    public function delete($id)
    {
        $fileId = File::where('id', $id)
            ->first();

        if (ProductImage::where('file_id', $fileId->id)->exists()) {
            ProductImage::where('file_id', $fileId->id)->delete();
        }

        $fileId->delete();

        return redirect()->back();
    }
}
