<?php

use App\repository\UserRepository;
use App\service\security\UserService;

require_once 'src/repository/UserRepository.php';
require_once 'src/service/security/UserService.php';
require_once 'src/controller/MainController.php';

$host = 'wdpai-bowling-club-db-1';
$port = '5433';
$dbname = 'bowling_club';
$username = 'admin';
$password = 'admin';

class DI
{
    const HOST = 'wdpai-bowling-club-db-1';
    const PORT = '5432';
    const DBNAME = 'bowling_club';
    const USER = 'admin';
    const PASSWORD = 'admin';
    private static PDO $PDO;
    private static $instance;
    public UserRepository $userRepository;
    public UserService $userService;
    public SecurityController $securityController;
    public MainController $mainController;

    public function __construct()
    {
        try {
            self::$PDO = new PDO(
                "pgsql:host=" . self::HOST . ";port=" . self::PORT . ";dbname=" . self::DBNAME,
                self::USER,
                self::PASSWORD
            );

            self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error while connecting the DB: " . $e->getMessage());
        }
        $this->userRepository = new UserRepository(self::$PDO);
        $this->userService = new UserService($this->userRepository);
        $this->securityController = new SecurityController($this->userService);
        $this->mainController = new MainController();
    }

    public static function getInstance(): DI
    {
        if (self::$instance === null) {
            self::$instance = new DI();
        }

        return self::$instance;
    }
}