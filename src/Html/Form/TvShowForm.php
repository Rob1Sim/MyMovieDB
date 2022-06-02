<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\StringEscaper;

class TvShowForm
{
    use StringEscaper;


    private ?TvShow $tvShow = null;

    /**
     * Construit un formulaire pour ajouter/supprimer une série
     * @param TvShow|null $tvShow
     */
    public function __construct(?TvShow $tvShow =null )
    {

        $this->$tvShow = &$tvShow;
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
        $oname = "";
        $homePage = "";
        $overview = "";
        if ($this->tvShow != null) {
            $this->tvShow->save();
            $name = self::escapeString($this->tvShow->getName());
            $oname = self::escapeString($this->tvShow->getOriginalName());
            $homePage = self::escapeString($this->tvShow->getHomePage());
            $overview = self::escapeString($this->tvShow->getOverview());
            $id = $this->tvShow->getId();
        }
        return <<<HTML
        <form action="$action" method="post" class="form">
            <input type="hidden" name="id" value="$id">
            <label for="name">Nom :</label>
            <input type="text" name="name" value="$name" required>
            <label for="orname">Nom original :</label>
            <input type="text" name="orname" value="$oname" required>
            <label for="homepage">Page de la série :</label>
            <input type="text" name="homepage" value="$homePage" required>
            <label for="overview">Résumé :</label>
            <input type="text" name="overview" value="$overview" required>
            <input type="submit" value="Enregistrer" class="form__button">
        </form>
HTML;
    }


    /***
     * Recupère les informations du formulaire pour les ajouter en propriétées d'instances
     * @return void
     * @throws ParameterException
     */
    public function setEntityFromQueryString(): void
    {
        if (($name = $_POST["name"]) != null && ($orname = $_POST["orname"]) != null && ($homePage = $_POST["homepage"])!= null && ($overview = $_POST["overview"])!=null ) {
            $name = $this->stripTagsAndTrim($name);
            $orname = $this->stripTagsAndTrim($orname);
            $homePage = $this->stripTagsAndTrim($homePage);
            $overview = $this->stripTagsAndTrim($overview);

            if (($id= (int)$_POST["id"]) != null && $id != 0) {
                $this->tvShow = TvShow::create($id,$name,$orname,$homePage,$overview);
            } else {
                $id = null;
                $this->tvShow = TvShow::create($id,$name,$orname,$homePage,$overview);
            }
        } else {
            throw new ParameterException();
        }
    }



}
