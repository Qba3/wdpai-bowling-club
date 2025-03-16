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

    public function login(string $message = null): void
    {
        $this->render('login', ["message" => $message]);
    }
}