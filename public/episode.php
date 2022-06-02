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
    $webPage->appendContent("<h3 class='nom_serie'><a href='season.php?showId={$season}'</h3>");
    $webPage->appendContent("<h4 class='nom_original_serie'>{$season->getName()}</h4>");
    $webPage->appendContent("</div></div</div");

    $bd = Entity\Collection\EpisodeCollection::findByEpisodeId($seasonId);

    foreach ($bd as $episode) {
        $name = AppWebPage::escapeString($episode->getName());
        $description = AppWebPage::escapeString($episode->getOverview());
        $webPage->appendContent(
            <<<HTML
                <div class="serie">
                    <h3 class='serie__txt'>Episode numero : {$episode->getEpisodeNumber()}</h3>
                    <h3 class='serie__txt'>{$name}</h3>
                    <h3 class='serie__txt'>{$description}</h3>
                </div>

HTML
        );
    }


    $webPage->appendContent("</div>");

    echo $webPage->toHTML();

} catch (EntityNotFoundException) {
    http_response_code(404);
}