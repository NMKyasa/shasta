<?php

namespace App\Core\Services;

class UploadService
{
    /**
     * Allowed image mime types
     */
    protected static array $allowedMimeTypes = [

        'image/jpeg',

        'image/png',

        'image/jpg',

        'image/webp'
    ];

    /**
     * Maximum file size
     *
     * 1MB
     */
    protected static int $maxFileSize =
        1048576;

    /**
     * Convert text into URL-friendly slug
     */
    protected static function slugify(
        string $text
    ): string
    {
        $text =
            strtolower($text);

        $text =
            preg_replace(
                '/[^a-z0-9]+/',
                '-',
                $text
            );

        return trim(
            $text,
            '-'
        );
    }

    /**
     * Upload image
     */
    public static function uploadImage(
        $file,
        $directory = 'services'
    )
    {
        /**
         * Validate upload errors
         */
        if (
            $file['error'] !== UPLOAD_ERR_OK
        ) {

            throw new \Exception(
                'Image upload failed.'
            );
        }

        /**
         * Validate file size
         */
        if (
            $file['size']
            >
            self::$maxFileSize
        ) {

            throw new \Exception(
                'Image exceeds 1MB limit.'
            );
        }

        /**
         * Validate mime type
         */
        if (
            !in_array(
                $file['type'],
                self::$allowedMimeTypes
            )
        ) {

            throw new \Exception(
                'Invalid image type.'
            );
        }

        /**
         * Validate actual image
         */
        if (
            !getimagesize(
                $file['tmp_name']
            )
        ) {

            throw new \Exception(
                'Invalid image file.'
            );
        }

        /**
         * File extension
         */
        $extension =
            strtolower(
                pathinfo(
                    $file['name'],
                    PATHINFO_EXTENSION
                )
            );

        /**
         * Original filename
         */
        $baseName =
            pathinfo(
                $file['name'],
                PATHINFO_FILENAME
            );

        /**
         * SEO-friendly filename
         */
        $baseName =
            self::slugify(
                $baseName
            );

        /**
         * Fallback if filename becomes empty
         */
        if (
            empty($baseName)
        ) {

            $baseName =
                'image';
        }

        /**
         * Final filename
         */
        $fileName =
            $baseName
            .
            '-'
            .
            time()
            .
            '.'
            .
            $extension;

        /**
         * Final upload path
         */
        $destination =
            __DIR__
            .
            '/../../../public/uploads/'
            .
            $directory
            .
            '/'
            .
            $fileName;

        /**
         * Upload directory
         */
        $uploadDirectory =
            dirname(
                $destination
            );

        /**
         * Auto-create directory
         */
        if (
            !is_dir(
                $uploadDirectory
            )
        ) {

            mkdir(
                $uploadDirectory,
                0777,
                true
            );
        }

        /**
         * Move uploaded file
         */
        if (
            !move_uploaded_file(
                $file['tmp_name'],
                $destination
            )
        ) {

            throw new \Exception(
                'Failed to save image.'
            );
        }

        /**
         * Return upload metadata
         */
        return [

            'file_name' =>
                $fileName,

            'original_name' =>
                $file['name'],

            'mime_type' =>
                $file['type'],

            'extension' =>
                $extension,

            'file_size' =>
                $file['size'],

            'file_path' =>
                'uploads/'
                .
                $directory
                .
                '/'
                .
                $fileName
        ];
    }
}