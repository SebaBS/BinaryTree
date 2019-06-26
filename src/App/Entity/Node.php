<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\NodeRepository")
 */
class Node extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $userName;
}