<?php

declare(strict_types=1);

namespace App\Application\Actions\File;

use App\Application\Actions\Action;
use App\Domain\File\Service\FileUpdate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class UpdateFileAction extends Action
{


    private $service;

    public function __construct(LoggerInterface $logger, FileUpdate $service)
    {
        parent::__construct($logger);

        $this->service = $service;
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
        $Id = (int) $this->resolveArg('id');


        $files = [];

        // handle multiple inputs with the same key
        foreach ($uploadedFiles as $uploadedFile) {
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

                $stream = (string) $uploadedFile->getStream();
                $filename  = $uploadedFile->getClientFilename();
                $extension = pathinfo($filename, PATHINFO_EXTENSION);


                $fileData = new \stdClass;
                $fileData->id = $Id;
                $fileData->name = $filename;
                $fileData->extension = $extension;
                $fileData->entity_name = $entity_name;
                $fileData->entity_id = $entity_id;
                $fileData->created_by = $current_user->id;

                $fileData = $this->service->update($Id,$fileData);

                $destinationFilePath = "\\" . $entity_name . "\\" . $entity_id . "\\" . $fileData->id . "_" . $filename;

                $this->filesystem->overwrite($destinationFilePath, $stream);

                array_push($files, $fileData);
            }
        }

        $this->logger->info("File of id " . $Id . " was updated successfully...");
        return $this->respondWithData($files);
    }
}
