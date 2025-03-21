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
    public function __construct(string $userId, string $day, string $hour, bool $drinkOffer)
    {
        $this->userId = $userId;
        $this->day = $day;
        $this->hour = $hour;
        $this->drinkOffer = $drinkOffer;
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

    /**
     * @return bool
     */
    public function isDrinkOffer(): bool
    {
        return $this->drinkOffer;
    }

    /**
     * @param bool $drinkOffer
     */
    public function setDrinkOffer(bool $drinkOffer): void
    {
        $this->drinkOffer = $drinkOffer;
    }
}