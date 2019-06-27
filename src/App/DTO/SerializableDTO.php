<?php


namespace App\DTO;


interface SerializableDTO
{
    public function toArray(): array;
}