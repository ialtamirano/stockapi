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

        $current_user = $this->request->getAttribute("current_user");

        $uploadedFiles = $this->request->getUploadedFiles();
        $queryParams = $this->request->getQueryParams();
        $entity_name =  $queryParams['entity_name'];
        $entity_id   =  $queryParams['entity_id'];
     


        $files = [];

        // handle multiple inputs with the same key
            foreach ($uploadedFiles as $uploadedFile) {
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

                    $stream = (string) $uploadedFile->getStream();
                    $filename  = $uploadedFile->getClientFilename();
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    
                    $fileData = new \stdClass;
                    $fileData->name = $filename;
                    $fileData->extension = $extension;
                    $fileData->entity_name = $entity_name;
                    $fileData->entity_id = $entity_id;
                    $fileData->created_by = $current_user->id;
                    

                    $fileData = $this->service->create($fileData);
                   
                    $destinationFilePath = "\\".$entity_name."\\".$entity_id."\\".$fileData->id."_". $filename;

                    $this->filesystem->write($destinationFilePath, $stream);


                    array_push($files,$fileData);
                    
                }
            }
    
        return $this->respondWithData($files);
    }
}
