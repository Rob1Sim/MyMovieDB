<?php

declare(strict_types=1);

namespace Entity;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private ?int $posterId;

    /**
     * Getter de l'id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter du tvShowId
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    /**
     * Getter du nom
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Getter du nombre de saison
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * Getter du posterId
     * @return ?int
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }


}