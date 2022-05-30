<?php
declare(strict_types=1);

namespace Entity;

class Poster
{
    private int $id;
    private string $jpeg;

    /**
     *Getter de l'id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getteur de l'image
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

}