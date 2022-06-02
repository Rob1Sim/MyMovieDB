<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class Episode
{
    private ?int $id;
    private ?int $seasonId;
    private string $name;
    private string $overview;
    private int $episodeNumber;

    /**
     * Getter de l'id
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter du seasonId
     * @return int
     */
    public function getSeasonId(): ?int
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
        return $this->overview;
    }

    /**
     * Getter du nombre d'épisode
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }

    /**
     * Setter de la propriété id
     * @param ?int $id
     */
    private function setId(?int $id): void
    {
        $this->id = $id;
    }


    /***
     * Supprime l'instance de la base de données
     * @return $this
     */
    public function delete(): Episode
    {
        $deleteReq = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    DELETE FROM episode
                    WHERE id= :idS
SQL
        );

        $deleteReq->execute(['idS'=>$this->id]);

        $this->setId(null);

        return $this;
    }
}
