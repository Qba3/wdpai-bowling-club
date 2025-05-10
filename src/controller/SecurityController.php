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
        $user = $this->userService->getUserByLogin($login);

        if ($user === null) {
            $this->render('login', ["message" => "User does not exist"]);
            return;
        }

        if (!$this->userService->verifyUser($user, $password)) {
            $this->render('login', ["message" => "Password is incorrect"]);
            return;
        }

        session_start();
        $userId = $this->userService->getUserIdByLogin($user->getLogin());
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $user->getFirstname();
        $_SESSION['roles'] = $this->userService->getUserRolesById($userId);


        $this->render('main');
    }

    public function addUser(string $firstname, string $lastname, string $login, string $email, string $password, array $roles): void
    {
        $user = $this->userService->getUserByLogin($login);
        if ($user !== null) {
            $this->render('register', ["message" => 'User with this login already exists']);
            return;
        }

        $user = $this->userService->getUserByEmail($email);
        if ($user !== null) {
            $this->render('register', ["message" => 'User with this email already exists']);
            return;
        }

        $user = new User($firstname, $lastname, $login, $email, $password);
        if ($this->userService->addUser($user, $roles)) {
            $this->render('login', ["message" => 'User created successfully']);
            return;
        }

        $this->render('register', ["message" => 'User could not be added - please contact the administrator']);
    }

    public function login(string $message = null): void
    {
        $this->render('login', ["message" => $message]);
    }

    public function logout(string $message = null): void
    {
        session_start();
        session_destroy();
        $this->render('login', ["message" => "You have been logged out"]);
    }

    public function register(string $message = null): void
    {
        $this->render('register', ["message" => $message]);
    }
}