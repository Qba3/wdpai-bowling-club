<?php

class Reservation
{
    private string $userId;
    private string $day;
    private string $hour;
    private bool $drinkOffer;

    /**
     * @param string $userId
     * @param string $day
     * @param string $hour
     * @param bool $drinkOffer
     */
    public function __construct(string $userId, string $day, string $hour)
    {
        $this->userId = $userId;
        $this->day = $day;
        $this->hour = $hour;
    }

    /**
     * @return mixed
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getHour(): string
    {
        return $this->hour;
    }

    /**
     * @param mixed $hour
     */
    public function setHour(string $hour): void
    {
        $this->hour = $hour;
    }
}