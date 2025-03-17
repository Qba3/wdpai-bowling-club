<?php

class User
{
    private string $firstname;
    private string $lastname;
    private string $login;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(string $firstname, string $lastname, string $login, string $email, string $password, string $role)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }


    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}