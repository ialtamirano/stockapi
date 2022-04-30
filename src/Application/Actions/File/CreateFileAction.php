<?php
declare(strict_types=1);

namespace App\Application\Actions\File;

use App\Application\Actions\Action;
use App\Domain\File\Service\FileCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use League\Flysystem\Filesystem;


class CreateFileAction extends Action
{

    
    private $service;
    private $filesystem;

    public function __construct( LoggerInterface $logger,Filesystem $filesystem ,FileCreate $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
        $this->filesystem = $filesystem;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        //$formData = $this->request;

        
        $uploadedFiles = $this->request->getUploadedFiles();
        $entity_name =  $this->request->getQueryParams()['entity_name'];
        $entity_id   =  $this->request->getQueryParams()['entity_id'];
        //var_dump($uploadedFiles);


        $files = [];

        // handle multiple inputs with the same key
            foreach ($uploadedFiles as $uploadedFile) {
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

                    $stream = (string) $uploadedFile->getStream();
                    $filename  = $uploadedFile->getClientFilename();

                    
                    $fileData = new \stdClass;
                    $fileData->name = $filename;

                    $fileData->entity_name = $entity_name;
                    $fileData->entity_id = $entity_id;

                    $fileData->id = $this->service->create($fileData);
                   
                    $destinationFilePath = "\\".$entity_name."\\".$entity_id."\\". $filename;

                    $this->filesystem->write($destinationFilePath, $stream);


                    array_push($files,$fileData);
                    
                }
            }
    
        return $this->respondWithData($files);
    }
}
