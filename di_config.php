<?php

use App\repository\ReservationRepository;
use App\repository\UserRepository;
use App\repository\UsersRolesRepository;
use App\service\reservation\ReservationService;
use App\service\security\UserService;
use App\service\usersRoles\UsersRolesMapper;

require_once 'src/controller/MainController.php';
require_once 'src/controller/SecurityController.php';
require_once 'src/controller/ReservationController.php';
require_once 'src/service/security/UserService.php';
require_once 'src/service/reservation/ReservationService.php';
require_once 'src/service/usersRoles/UsersRolesMapper.php';
require_once 'src/repository/UserRepository.php';
require_once 'src/repository/ReservationRepository.php';
require_once 'src/repository/UsersRolesRepository.php';

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
    public ReservationRepository $reservationRepository;
    public ReservationService $reservationService;
    public ReservationController $reservationController;
    public UsersRolesRepository $usersRolesRepository;
    public UserRepository $userRepository;
    public UserService $userService;
    public SecurityController $securityController;
    public MainController $mainController;
    private UsersRolesMapper $usersRolesMapper;

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

        $this->usersRolesRepository = new UsersRolesRepository(self::$PDO);
        $this->usersRolesMapper = new UsersRolesMapper();

        $this->userRepository = new UserRepository(self::$PDO, $this->usersRolesRepository, $this->usersRolesMapper);
        $this->userService = new UserService($this->userRepository);
        $this->securityController = new SecurityController($this->userService);

        $this->reservationRepository = new ReservationRepository(self::$PDO);
        $this->reservationService = new ReservationService($this->reservationRepository);
        $this->reservationController = new ReservationController($this->reservationService);

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