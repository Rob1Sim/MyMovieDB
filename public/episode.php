<?php
declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;


try {
    if (isset($_GET['seasonId']) && !empty(($_GET['seasonId'])) && ctype_digit($_GET['seasonId'])) {
        $seasonId = (int)$_GET['seasonId'];
    } else {
        header("Location: /index.php ");
        exit;
    }

    $webPage = new AppWebPage();

    $season = Entity\Collection\SeasonCollection::findBySeasonId($seasonId);
    $string = AppWebPage::escapeString($season->getName());
    $res = Entity\Collection\TvShowCollection::findByTvShowId($season->getTvShowId());
    $string2 = AppWebPage::escapeString($res->getName());
    $webPage->setTitle("Serie TV : $string2 : $string");

    $webPage->appendContent("<div class='btn__home' onclick=\"location.href='/';\"><p>Accueil</p></div>");
    $webPage->appendContent("<div class='list' id='list__season'>");

    $webPage->appendContent("<div class=serie__pres>");
    $webPage->appendContent("<div class='serie__image'><img src='poster.php?posterId=".$season->getPosterId()."' alt='poster de la série'></div>");
    $webPage->appendContent("<div class='serie__txt'>");
    $webPage->appendContent("<div class='serie__txt__nom'>");

    $show = \Entity\Collection\TvShowCollection::findByTvShowId($season->getTvShowId());

    echo $show->getHomePage();
    $name = \Html\WebPage::escapeString($show->getName());
    $nameS = \Html\WebPage::escapeString($season->getName());
    $seasonId = $season->getId();
    $webPage->appendContent("<h3 class='nom_original_serie'><a class ='link' href='season.php?showId={$show->getId()}'>{$name}</a></h3>");
    $webPage->appendContent("<h3 class='nom_original_serie'>{$nameS}</h3>");
    $webPage->appendContent("");
    $webPage->appendContent(
        <<<HTML
                    <div class="admin__btn" onclick="location.href='admin/delete-form.php?seasonId=$seasonId';">
                        <p>Supprimer</p>
                    </div>
                </div>
</div>
</div>
HTML);

    $bd = Entity\Collection\EpisodeCollection::findByEpisodeId($seasonId);

    foreach ($bd as $episode) {
        $name = AppWebPage::escapeString($episode->getName());
        $description = AppWebPage::escapeString($episode->getOverview());
        $id = $episode->getId();
        $webPage->appendContent(
            <<<HTML
                <div class="episode">
                    <h3 class='episode__txt'>Episode numero : {$episode->getEpisodeNumber()} - {$name}</h3>
                    <p class='episode__txt'>{$description}</p>
                    <div class="admin__btn" onclick="location.href='admin/delete-form.php?epId=$id';">
                        <p>Supprimer</p>
                    </div>
                </div>

HTML
        );
    }


    $webPage->appendContent("</div>");

    echo $webPage->toHTML();

} catch (EntityNotFoundException) {
    http_response_code(404);
}