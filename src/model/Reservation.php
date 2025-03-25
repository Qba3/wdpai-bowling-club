<?php

class Reservation
{
    private int $id;
    private string $userId;
    private string $day;
    private string $hour;

    /**
     * @param string $userId
     * @param string $day
     * @param string $hour
     */
    public function __construct(string $userId, string $day, string $hour)
    {
        $this->userId = $userId;
        $this->day = $day;
        $this->hour = $hour;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @param string $day
     */
    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    /**
     * @return string
     */
    public function getHour(): string
    {
        return $this->hour;
    }

    /**
     * @param string $hour
     */
    public function setHour(string $hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}