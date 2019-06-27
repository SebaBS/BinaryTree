<?php


namespace App\DTO;


interface NodeContentDTO extends SerializableDTO
{
    /**
     * Method returns identification data from DTO
     * @return int
     */
    public function getId(): int;
}