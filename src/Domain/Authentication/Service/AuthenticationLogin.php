<?php


namespace App\Domain\Authentication\Service;

use App\Domain\Authentication\Repository\AuthenticationLoginRepository;
use App\Domain\DomainException\DomainValidationException;

use \Firebase\JWT\JWT;

/**
 * Service.
 */
final class AuthenticationLogin
{
    /**
     * @var AuthenticationLoginRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AuthenticationLoginRepository $repository The repository
     */
    public function __construct(AuthenticationLoginRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Login 
     *
     * @param array $data The form data
     *
     * @return int The new account ID
     */
    public function login($data)
    {
        $this->validateAccountData($data);

 
         $verifyAccount = $this->verifyAccount($data);
  
         if($verifyAccount==false)
         {
            throw new DomainValidationException('invalid username or password',[]);           
         }
  
         //Generate Token
         $verifyAccount->token = $this->generateToken($data->email_address);
         $verifyAccount->password ="";
        // Input validation

        return $verifyAccount;
    }

    public function verifyAccount($data) 
    {
        $hash_password ="";
        $user = $this->repository->findByEmail($data->email_address);

        if(!$user)
        {
            return false;
        }

        $hash_password = $user->password;
        
        $verify = password_verify($data->password,$hash_password);

        if($verify==false)
        {
            return false;
        }

        return $user;
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
    private function validateAccountData($data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library        
        if (empty($data->email_address)) {
            $errors['email'] = 'Email required';
        } elseif (filter_var($data->email_address, FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Invalid email address';
        }

        if (empty($data->password)) {
            $errors['password'] = 'Password required';
        }

        if ($errors) {
            throw new DomainValidationException('Please check your input', $errors);
        }
    }

    private function generateToken($email){
        
            $now = time();
            $future = strtotime('+2 hour',$now);
            $secret = $_ENV['JWT_SECRET'];
    
            $payload = [
              "jti"=>$email,
              "iat"=>$now,
              "exp"=>$future,
              "scopes" => []
            ];
    
          
            return JWT::encode($payload,$secret,"HS256");
        
    }
}