<?php

namespace App\Services;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use ErrorException;
use Illuminate\Http\UploadedFile;

class S3
{
    private $s3;

    public function __construct()
    {
        $this->s3 = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-2'
        ]);
    }

    public function put(UploadedFile $uploadedFile)
    {
        try {
            $result = $this->s3->putObject([
                'Bucket' => 'job-portal-cloudstaff-bucket',
                'Key' => $uploadedFile->hashName(),
                'SourceFile' => $uploadedFile->path(),
                'ACL' => 'public-read'
            ]);

            return $result['ObjectURL'];
        } catch (S3Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
