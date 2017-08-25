<?php

namespace App\Controllers;

use PhpBoot\Application;
use PhpBoot\DI\Traits\EnableDIAnnotations;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * 演示文件上传
 * @path /files
 */
class Files
{
    use EnableDIAnnotations;
    /**
     * 上传文件
     *
     * @route POST /files/
     *
     * @param string $fileName {@v lengthMax:32} 文件名
     * @param string $file {@bind request.files.file} 需要上传的文件
     * @return string 文件 url
     */
    public function uploadFile($fileName, $file)
    {
        $uploadDir = realpath(__DIR__.'/../../public/upload/');
        $uploadFile = $uploadDir.'/'.$fileName;

        $uploadDir == dirname(realpath($uploadFile)) or \PhpBoot\abort(new BadRequestHttpException('invalid file name'));
        move_uploaded_file($file, $uploadFile)
            or \PhpBoot\abort('move_uploaded_file failed');

        return "http://{$this->host}/upload/.$fileName";
    }

    /**
     * @inject host
     * @var string
     */
    private $host;
}