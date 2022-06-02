<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\TvShow;
use Html\StringEscaper;

class tvShowForm
{
    use StringEscaper;


    private ?TvShow $tvShow;

    /**
     * Construit un formulaire pour ajouter/supprimer une série
     * @param TvShow|null $tvShow
     */
    public function __construct(?TvShow $tvShow = null)
    {
        $this->$tvShow = $tvShow;
    }

    /**
     * Récupère le tvshow
     * @return TvShow|null
     */
    public function getTvShow(): ?TvShow
    {
        return $this->tvShow;
    }

    /**
     * Créer un formulaire pour inserer ou modifier des artistes de la base de donnée
     * @param string $action
     * @return string
     */
    public function getHtmlForm(string $action): string
    {
        $id ="";
        $name ="";
        if ($this->tvShow != null) {
            $this->tvShow->save();
            $name = self::escapeString($this->tvShow->getName());
            $oname = self::escapeString($this->tvShow->getOriginalName());
            $homePage = self::escapeString($this->tvShow->getHomePage());
            $overview = self::escapeString($this->tvShow->getOverview());
            $poster = $this->tvShow->getPosterId();
            $id = $this->tvShow->getId();
        }
        return <<<HTML
        <form action="$action" method="post">
            <input type="hidden" name="id" value="$id">
            <label for="name">Nom</label>
            <input type="text" name="name" value="$name" required>
            <label for="orname">Nom original</label>
            <input type="text" name="orname" value="$oname" required>
            <label for="homepage">Nom original</label>
            <input type="text" name="homepage" value="$homePage" required>
            <label for="overview">Nom original</label>
            <input type="text" name="overview" value="$overview" required>
            <input type="hidden" name="posterId" value="$poster">
            <input type="submit" value="Enregistrer">
        </form>
HTML;
    }


}
