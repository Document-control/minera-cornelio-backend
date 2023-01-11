<?php

namespace App\Services;


final class GalleryDocsService
{
  public function getFiles($file)
  {
    return 'https://' . env('AWS_BUCKET') . '.s3.amazonaws.com/' . $file;
  }
}
