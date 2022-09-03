<?php
declare(strict_types=1);

namespace App\Application\Actions\File;

use App\Application\Actions\Action;
use App\Domain\File\Service\FileView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use League\Flysystem\Filesystem;

class ServeFileAction extends Action
{

    
    private $service;
    private $filesystem;

    public function __construct( LoggerInterface $logger,Filesystem $filesystem,FileView $service)
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
        $id =  $this->resolveArg('id');
       
        $file = $this->service->view($id);

        $destinationFilePath = "\\".$file->entity_name."\\".$file->entity_id."\\".$file->id."_". $file->name;

        try {
            //$mime = mime_content_type($destinationFilePath);
            $mime = $this->filesystem->mimeType($destinationFilePath);
           // exit;
            $response = $this->filesystem->read($destinationFilePath);

        } catch (FilesystemException | UnableToReadFile $exception) {
            // handle the error
        }    

        $this->logger->info("File of id ".$file->id." was updated successfully.");

        return $this->respondWithContent($response,$mime);
    }
}