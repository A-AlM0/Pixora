<?php

class ImageHelper
{
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/gif'  => 'gif'
    ];

    private const MAX_FILE_SIZE = 8 * 1024 * 1024; // 8 MB

    /**
     * Validate and process an uploaded image.
     *
     * @param array  $file              $_FILES entry
     * @param string $destinationFolder Target directory (e.g. 'uploads/posts/')
     * @param int    $maxWidth          Max image width for resizing
     * @param int    $maxHeight         Max image height for resizing
     * @param int    $quality           Compression quality (0-100)
     * @return array [success => bool, path => string|null, error => string|null]
     */
    public static function processUpload(
        array $file,
        string $destinationFolder,
        int $maxWidth = 1920,
        int $maxHeight = 1920,
        int $quality = 85
    ): array {
        // 1. Check basic upload error
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return [
                'success' => false,
                'path' => null,
                'error' => self::getUploadErrorMessage($file['error'] ?? UPLOAD_ERR_NO_FILE)
            ];
        }

        // 2. Check file size
        if ($file['size'] > self::MAX_FILE_SIZE) {
            return [
                'success' => false,
                'path' => null,
                'error' => 'File size exceeds maximum allowed limit (8 MB).'
            ];
        }

        // 3. Validate MIME type securely using finfo
        $tmpPath = $file['tmp_name'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($tmpPath);

        if (!array_key_exists($mimeType, self::ALLOWED_MIME_TYPES)) {
            return [
                'success' => false,
                'path' => null,
                'error' => 'Invalid file type. Only JPEG, PNG, WebP, and GIF images are allowed.'
            ];
        }

        $extension = self::ALLOWED_MIME_TYPES[$mimeType];

        // 4. Ensure target directory exists
        $destinationFolder = rtrim($destinationFolder, '/\\') . '/';
        if (!is_dir($destinationFolder)) {
            if (!mkdir($destinationFolder, 0755, true) && !is_dir($destinationFolder)) {
                return [
                    'success' => false,
                    'path' => null,
                    'error' => 'Failed to create destination directory.'
                ];
            }
        }

        // 5. Generate secure random unique filename
        $uniqueName = bin2hex(random_bytes(8)) . '_' . time() . '.' . $extension;
        $targetPath = $destinationFolder . $uniqueName;

        // 6. Resize & optimize if GD is available
        if (extension_loaded('gd') && $mimeType !== 'image/gif') {
            $optimized = self::resizeAndSaveImage($tmpPath, $targetPath, $mimeType, $maxWidth, $maxHeight, $quality);
            if ($optimized) {
                return ['success' => true, 'path' => $targetPath, 'error' => null];
            }
        }

        // Fallback to standard move_uploaded_file if GD is unavailable or skipped
        if (move_uploaded_file($tmpPath, $targetPath)) {
            return ['success' => true, 'path' => $targetPath, 'error' => null];
        }

        return [
            'success' => false,
            'path' => null,
            'error' => 'Failed to move uploaded file to destination.'
        ];
    }

    /**
     * Resizes and compresses image using GD library.
     */
    private static function resizeAndSaveImage(
        string $sourcePath,
        string $targetPath,
        string $mimeType,
        int $maxWidth,
        int $maxHeight,
        int $quality
    ): bool {
        list($origWidth, $origHeight) = @getimagesize($sourcePath);
        if (!$origWidth || !$origHeight) {
            return false;
        }

        // Load image resource
        $sourceImage = match ($mimeType) {
            'image/jpeg' => @imagecreatefromjpeg($sourcePath),
            'image/png'  => @imagecreatefrompng($sourcePath),
            'image/webp' => @imagecreatefromwebp($sourcePath),
            default      => null
        };

        if (!$sourceImage) {
            return false;
        }

        // Calculate proportional aspect ratio
        $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight, 1.0);
        $newWidth  = (int) round($origWidth * $ratio);
        $newHeight = (int) round($origHeight * $ratio);

        // Create new truecolor image canvas
        $canvas = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG and WebP
        if ($mimeType === 'image/png' || $mimeType === 'image/webp') {
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
            imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $transparent);
        }

        // Resample image
        imagecopyresampled(
            $canvas,
            $sourceImage,
            0, 0, 0, 0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        // Save output
        $saved = match ($mimeType) {
            'image/jpeg' => imagejpeg($canvas, $targetPath, $quality),
            'image/png'  => imagepng($canvas, $targetPath, (int) round((100 - $quality) / 10)),
            'image/webp' => imagewebp($canvas, $targetPath, $quality),
            default      => false
        };

        // Free memory
        imagedestroy($sourceImage);
        imagedestroy($canvas);

        return $saved;
    }

    private static function getUploadErrorMessage(int $errorCode): string
    {
        return match ($errorCode) {
            UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
            UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form.',
            UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded.',
            UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder on the server.',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
            UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.',
            default               => 'Unknown upload error.'
        };
    }
}
