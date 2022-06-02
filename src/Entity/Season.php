<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class Season
{
    private ?int $id;
    private ?int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private ?int $posterId;

    /**
     * Getter de l'id
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter du tvShowId
     * @return int|null
     */
    public function getTvShowId(): ?int
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
    public function delete(): Season
    {
        $deleteReq = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    DELETE FROM season
                    WHERE id= :idS
SQL
        );

        $deleteReq->execute(['idS'=>$this->id]);

        $this->setId(null);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Je ne sais pas pourquoi quand je met ça ici ça marche mais ça marche";
    }
}
