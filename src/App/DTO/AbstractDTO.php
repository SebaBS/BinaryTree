<?php


namespace App\DTO;


abstract class AbstractDTO implements SerializableDTO
{
    /**
     * @var int
     */
    protected $id;

    /**
     * AbstractDTO constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->setId($id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()
        ];
    }
}