<?php
namespace App\Http\Helpers;

use Illuminate\Support\Str;

class FileHelper
{
    public static function upload($file, $path)
    {
        $fileName = time(). '-'. Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $fileName);
        return $path . '/' . $fileName;
    }

    public static function delete($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
    public static function update($oldPath, $newFile, $destination)
    {
        // Delete old file
        if ($oldPath && file_exists(public_path($oldPath))) {
            unlink(public_path($oldPath));
        }

        // Upload new file
        $filename = time() . '_' . $newFile->getClientOriginalName();
        $newFile->move(public_path($destination), $filename);

        return $destination . '/' . $filename;
    }

    public static function get($file, $path)
    {
        return asset($path . '/' . $file);
    }
}