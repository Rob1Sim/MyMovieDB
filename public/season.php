<?php
declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;

if (isset($_GET['seasonId']) && !empty(($_GET['seasonId'])) && ctype_digit($_GET['seasonId'])) {
    $tvshowId = (int)$_GET['seasonId'];
} else {
    header("Location: /index.php ");
    exit;
}

try {
    $webPage = new AppWebPage();

    $tvshow = Entity\Collection\TvShowCollection::findByTvShowId($tvshowId);

    $string = AppWebPage::escapeString($tvshow->getName());
    $webPage->setTitle("Serie TV : $string");

    $webPage->appendContent("<div class='btn__home' onclick=\"location.href='/';\"><p>Accueil</p></div>");

    if ($bd = Entity\Collection\SeasonCollection::findBySeasonId($tvshowId)){
        $webPage->appendContent("<div class='list' id='list__season'>");

        $webPage->appendContent("<div class=serie__pres>");
        $webPage->appendContent("<div class='serie__image'><img src='poster.php?posterId=".$tvshow->getPosterId()."' alt='poster de la série'></div>");
        $webPage->appendContent("<div class='serie__txt'>");
        $webPage->appendContent("<div class='serie__txt__nom'>");

        $name = \Html\WebPage::escapeString($tvshow->getName());
        $oname = \Html\WebPage::escapeString($tvshow->getOriginalName());
        $overview = \Html\WebPage::escapeString($tvshow->getOverview());
        $idShow = $tvshow->getId();

        $webPage->appendContent("<h3 class='nom_serie'>$name</h3>");
        $webPage->appendContent("<h4 class='nom_original_serie'>$oname</h4>");
        $webPage->appendContent("</div>");
        $webPage->appendContent("<p class='overview_serie'>$overview</p>");
        $webPage->appendContent(<<<HTML
                <div class="btn__bar">
                    <div class="admin__btn" onclick="location.href='admin/delete-form.php?showId=$idShow';">
                        <p>Supprimer</p>
                    </div>
                    <div class="admin__btn" onclick="location.href='admin/index.php?showId=$idShow';">
                        <p>Modifier</p>
                    </div>
                </div>
           </div> 
HTML);
        $webPage->appendContent("</div>");


        foreach ($bd as $season) {
            $poster = $season->getPosterId();
            $name = AppWebPage::escapeString($season->getName());
            $webPage->appendContent(
                <<<HTML
                <div class='serie' onclick="location.href='season.php?seasonId=';">
                    <div class="serie__image"><img src="poster.php?posterId={$season->getPosterId()}" alt='poster de la série'></div>
                    <h3 class='serie__txt'>{$name}</h3>
                </div>

HTML
            );
        }
        $webPage->appendContent("</div>");
    } else{
        $webPage->appendContent("<div class=serie__pres>");
        $webPage->appendContent("<div class='serie__image'><img src='poster.php?posterId=".$tvshow->getPosterId()."' alt='poster de la série'></div>");
        $webPage->appendContent("<div class='serie__txt'>");
        $webPage->appendContent("<div class='serie__txt__nom'>");

        $name = \Html\WebPage::escapeString($tvshow->getName());
        $oname = \Html\WebPage::escapeString($tvshow->getOriginalName());
        $overview = \Html\WebPage::escapeString($tvshow->getOverview());
        $idShow = $tvshow->getId();

        $webPage->appendContent("<h3 class='nom_serie'>$name</h3>");
        $webPage->appendContent("<h4 class='nom_original_serie'>$oname</h4>");
        $webPage->appendContent("</div>");
        $webPage->appendContent("<p class='overview_serie'>$overview</p>");
        $webPage->appendContent(<<<HTML
                <div class="btn__bar">
                    <div class="admin__btn" onclick="location.href='admin/delete-form.php?showId=$idShow';">
                        <p>Supprimer</p>
                    </div>
                    <div class="admin__btn" onclick="location.href='admin/index.php?showId=$idShow';">
                        <p>Modifier</p>
                    </div>
                </div>
           </div> 
HTML);
        $webPage->appendContent("</div>");
    }




    echo $webPage->toHTML();
} catch (EntityNotFoundException) {
    http_response_code(404);
}
