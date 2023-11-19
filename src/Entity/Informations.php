<?php

namespace App\Entity;

class Informations
{
    private ?string $address = null;
    private ?string $telephone = null;
    private ?string $timetable = null;

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     */
    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string|null
     */
    public function getTimetable(): ?string
    {
        return $this->timetable;
    }

    /**
     * @param string|null $timetable
     */
    public function setTimetable(?string $timetable): void
    {
        $this->timetable = $timetable;
    }
}