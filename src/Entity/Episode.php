<?php
declare(strict_types=1);

namespace Entity;

class Episode
{
    private int $id;
    private int $seasonId;
    private string $name;
    private string $overview;
    private int $episodeNumber;

    /**
     * Getter de l'id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter du seasonId
     * @return int
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
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
        return $this->overviewr;
    }

    /**
     * Getter du nombre d'épisode
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumer;
    }


}