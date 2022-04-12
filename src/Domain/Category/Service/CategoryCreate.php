<?php


namespace App\Domain\Category\Service;

use App\Domain\Category\Repository\CategoryRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CategoryCreate
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CategoryRepository $repository The repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Create a new account.
     *
     * @param array $data The form data
     *
     * @return int The new account ID
     */
    public function create($data): int
    {
        // Input validation
        $this->validateNew($data);

        // Part Number exist validation
        if($this->categoryExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de categoria ya existe!", []);     
        }

      
        // Create account
        $categoryId = $this->repository->create($data);

        return $categoryId;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws DomainValidationException
     *
     * @return void
     */
    private function validateNew($data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data->code)) {
            $errors['code'] = 'El código  es requerido!';
        }


        if (empty($data->name)) {
            $errors['name'] = 'El nombre es requerido!';
        }

       

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    private function categoryExist($categoryCode)
    {
        $result =  $this->repository->findByCode($categoryCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}