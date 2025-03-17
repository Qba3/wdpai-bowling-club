<?php

use App\service\security\UserService;

require_once "Controller.php";
require_once __DIR__ . '/../model/User.php';

class SecurityController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function verify(string $login, $password): void
    {
        $user = $this->userService->getUser($login);

        if ($user === null) {
            $this->render('login', ["message" => "User does not exist"]);
            return;
        }

        if (!$this->userService->verifyUser($user, $password)) {
            $this->render('login', ["message" => "Password is incorrect"]);
            return;
        }
        $this->render('main');
        print_r("Welcome " . $user->getFirstname() . "!");
    }

    public function addUser(string $firstname, string $lastname, string $login, string $email, string $password, string $role): void
    {
        $user = $this->userService->getUser($login);

        $user = new User($firstname, $lastname, $login, $email, $password, $role);
        $this->userService->addUser($user);

    }

    public function login(string $message = null): void
    {
        $this->render('login', ["message" => $message]);
    }

    public function register(string $message = null): void
    {
        $this->render('register', ["message" => $message]);
    }
}