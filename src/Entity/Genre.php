<?php

declare(strict_types=1);

namespace Entity;

class Genre
{
    private int $id;
    private string $name;

    /**
     * Getter de l'id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter du nom du genre
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
