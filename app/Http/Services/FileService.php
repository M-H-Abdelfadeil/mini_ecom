<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class FileService
{
    /**
     * Upload multiple files to a specific folder and return their generated names.
     *
     * @param array $files Array of uploaded file objects.
     * @param string $type Folder type to categorize files under.
     * @return array List of uploaded file names.
     */
    public static function upload_multi($files, $type)
    {
        $names = [];

        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $file_name = self::rand_text() . "." . $extension;

            $file->move(self::folder_save() . $type, $file_name);

            $names[] = ['name' => $file_name];
        }

        return $names;
    }

    /**
     * Upload a single file and return its path and original name.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $type Folder type to categorize file under.
     * @return array Contains the file path and original name.
     */
    public static function upload($file, $type)
    {
        $origin_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $file_name = self::rand_text() . "." . $extension;

        $file->move(self::folder_save() . $type, $file_name);

        $path_file = "uploads/" . trim($type, "/") . "/" . $file_name;

        return ['path' => $path_file, 'origin_name' => $origin_name];
    }

    /**
     * Delete multiple files from the given path or full path.
     *
     * @param array $files List of filenames or full paths.
     * @param string|null $type Folder name to prefix the file with.
     */
    public static function delete_multi_files($files, $type = null)
    {
        foreach ($files as $file) {
            if (!$file) continue;

            $file_path = $type ? $type . "/" . $file : $file;

            if (File::exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    /**
     * Delete a single file with optional folder prefix.
     * Skips files inside protected folders like upload-test or default-images.
     *
     * @param string $file_name Relative or full path of file.
     * @param string|null $type Optional folder type.
     */
    public static function delete($file_name, $type = null)
    {
        $file_name_path = explode("/", $file_name);

        if (!in_array($file_name_path[0], ["upload-test", "default-images"])) {
            $file_path = $type ? $type . "/" . $file_name : $file_name;

            if (File::exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    /**
     * Generate a unique random string for file naming.
     *
     * @return string
     */
    private static function rand_text()
    {
        return Str::random(20) . time();
    }

    /**
     * Get the base path for storing uploaded files.
     *
     * @return string
     */
    private static function folder_save()
    {
        return public_path('uploads/');
    }

    /**
     * Create a zip archive from given files and save it in the provided path.
     *
     * @param array $files List of file paths to include.
     * @param string $path Folder where the zip file should be stored.
     * @return array Zip archive status and path.
     */
    public static function create_zip_archive($files = [], $path)
    {
        $directory_path = public_path($path);

        // Ensure directory exists
        if (!file_exists($directory_path)) {
            mkdir($directory_path, 0777, true);
        }

        $zip = new \ZipArchive;
        $path = trim($path, "/");
        $zip_file_name = self::rand_text() . ".zip";
        $zip_file_path = public_path($path . "/" . $zip_file_name);

        if ($zip->open($zip_file_path, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($files as $file) {
                $file_path = public_path($file);
                if (file_exists($file_path)) {
                    $zip->addFile($file_path, basename($file_path));
                }
            }

            $zip->close();

            return [
                "status" => true,
                "path" => $path . "/" . $zip_file_name
            ];
        }

        return [
            "status" => false,
        ];
    }

    /**
     * Get the maximum allowed upload size (in kilobytes).
     *
     * @return int
     */
    public static function get_max_upload_size()
    {
        return 5 * 1024; // 5MB
    }

    /**
     * Format a byte value into a human-readable string.
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    public static function format_file_size($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
        $power = min($power, count($units) - 1);

        $size = $bytes / pow(1024, $power);

        return round($size, $precision) . ' ' . $units[$power];
    }



    /**
     * Extract file extension from a given URL or file path.
     *
     * @param string $url
     * @return string
     */
    public static function get_ext($url)
    {
        $parsed_url = parse_url($url, PHP_URL_PATH);
        return pathinfo($parsed_url, PATHINFO_EXTENSION);
    }
}
