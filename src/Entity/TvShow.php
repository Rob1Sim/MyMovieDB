<?php
declare(strict_types=1);

namespace Entity;

class TvShow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homePage;
    private string $overview;
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
     * Getter du nom original
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
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
     * Getter du overview
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Getter de la page d'accueil
     * @return string
     */
    public function getHomePage(): string
    {
        return $this->homePage;
    }

    /**
     * Getter d'id du poster
     * @return ?int
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }
}
