<?php


namespace App\Domain\Authentication\Service;

use App\Domain\Authentication\Repository\AuthenticationRegisterRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class AuthenticationRegister
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param Authentication $repository The repository
     */
    public function __construct(AuthenticationRegisterRepository $repository)
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
    public function register($data): int
    {
        // Input validation
        $this->validateNewAuthentication($data);

        // Email exist validation
        if($this->emailExist($data->email_address) )
        { 
            throw new DomainValidationException("This email already exists", []);     
        }

        $password_hash = $this->hashPassword($data->password);

        $data->password = $password_hash;
        
        //var_dump($data);
        //exit;
        // Create account
        $accountId = $this->repository->register($data);

        $data->password = "";

        // Logging here: Authentication created successfully
       // $this->logger->info(sprintf('Authentication created successfully: %s', $accountId));

        return $accountId;
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
    private function validateNewAuthentication( $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data->full_name)) {
            $errors['full_name'] = 'User name required';
        }

        if (empty($data->email_address)) {
            $errors['email_address'] = 'Email required';
        } elseif (filter_var($data->email_address, FILTER_VALIDATE_EMAIL) === false) {
            $errors['email_address'] = 'Invalid email address';
        }

        if (empty($data->password)) {
            $errors['password'] = 'Password is required';
        }

        if ($errors) {
            throw new DomainValidationException('Please check your input', $errors);
        }
    }


    private function emailExist($email)
    {
        $email_result =  $this->repository->findByEmail($email);

        if(!$email_result)
        {
            return false;
        }
        return true;
    }


    private  function hashPassword($password)
    {
        //var_dump($password);
        //exit;
        return password_hash($password,PASSWORD_BCRYPT);
    }

   
}