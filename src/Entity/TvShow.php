<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class TvShow
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homePage;
    private string $overview;
    private ?int $posterId;


    private function __construct(?int $id = null, string $name = "", string $ogn = "", string $hp = "", string $overview = "", ?int $pId = 999)
    {
        $this->id = $id;
        $this->name = $name;
        $this->originalName = $ogn;
        $this->homePage = $hp;
        $this->overview = $overview;
        $this->posterId = $pId;
    }

    /**
     * Getter de l'id
     * @return ?int
     */
    public function getId(): ?int
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

    /**
     * Setter de la propriété id
     * @param ?int $id
     */
    private function setId(?int $id): void
    {
        $this->id = $id;
    }


    /***
     * Supprime l'instance de la base de donnéees
     * @return $this
     */
    public function delete(): TvShow
    {
        $deleteReq = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    DELETE FROM tvshow
                    WHERE id= :idS
SQL
        );

        $deleteReq->execute(['idS'=>$this->id]);

        $this->setId(null);

        return $this;
    }

    /***
     * Insert une ligne dans la base de donnée
     * @return $this
     */
    protected function insert(): TvShow
    {
        $insertReq = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    INSERT INTO tvshow (name,originalName,homePage,overview,posterId) VALUES
                    (:nomArt,:orName,:hPage,:over,:pId)
SQL
        );

        $insertReq->execute(['nomArt'=>$this->name,'orName'=>$this->originalName,'hPage'=>$this->homePage,'over'=>$this->overview,'pId'=>$this->posterId]);

        $newId = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    SELECT id 
                    from tvshow
                    WHERE name = :nomShow;
SQL
        );

        $newId->execute(['nomShow'=>$this->name]);

        $this->setId((int)$newId->fetch()["id"]);


        return $this;
    }

    /***
     * Met à jour le nouveau nom de l'instance dans la base de donnée
     * @return $this
     */
    protected function update(): TvShow
    {
        $updateReq = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    UPDATE tvshow
                    SET name = :n, originalName = :orn, homePage = :hp ,overview = :over
                    WHERE id= :idShow
SQL
        );

        $updateReq->execute(['idShow'=>$this->id,'n'=>$this->name,'orn'=>$this->originalName,'hp'=>$this->homePage,'over'=>$this->overview]);

        return $this;
    }

    /***
     * Créer une instance de la class Artist.
     *
     * @param string $name Nom de la série.
     * @param int|null $id Id de la série.
     * @return TvShow L'artiste créé.
     */
    public static function create(?int $id = null, string $name, string $ogn, string $hp, string $over): TvShow
    {
        return new TvShow($id, $name, $ogn, $hp, $over);
    }

    /***
     * Met à Jour ou créer une donnée de l'instance dans la base de donnée.
     *
     * @return $this
     */
    public function save(): TvShow
    {
        if ($this->id == null) {
            $this->insert();
        } else {
            $this->update();
        }

        return $this;
    }

}
