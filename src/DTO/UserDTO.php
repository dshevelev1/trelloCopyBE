<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    #[Assert\NotBlank(message: "Username is required")]
    private $username;

    #[Assert\NotBlank(message: "Email is required")]
    #[Assert\Email(message: "Wrong email")]
    private $email;

    #[Assert\NotBlank(message: "Password is required")]
    #[Assert\Length(
        min: 8,
        minMessage: 'Your password must be at least {{ limit }} characters long',
    )]
    private $password;

    /**
     * @param $username
     * @param $email
     * @param $password
     */
    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
