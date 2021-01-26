<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Event\Event;


class VichImageHandling
{
    private $quality = 40; //Качество в процентах. В данном случае будет сохранено 50% от начального качества.

    public function resizeImage(Event $event)
    {
        $uploadedFile = $event->getObject();
         $file = $uploadedFile->getImageFile() ? $uploadedFile->getImageFile() : $uploadedFile->getSecondImageFile();

        if ($file instanceof File) {
            $this->resize($file->getPath(), $file->getFileName(), $file->getExtension(), $file->getRealPath());
        }
    }

    private function resize($path, $filename, $extension, $tmp_name)
    {
        if ($extension === 'jpeg' || $extension === 'jpg') {
            $source = imagecreatefromjpeg($tmp_name);
            imagejpeg($source, $path . '/' . $filename, $this->quality); //Сохраняем созданное изображение по указанному пути в формате jpg
            imagedestroy($source);//Чистим память
        }
//        if ($extension === 'png') {
//            $source = imagecreatefrompng($tmp_name);
//            imagepng($source, $path . '/' . $filename,0); //Сохраняем созданное изображение по указанному пути в формате png
//            imagedestroy($source);//Чистим память
//        }
    }
}