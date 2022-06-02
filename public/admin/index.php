<?php

declare(strict_types=1);

use Entity\Collection\TvShowCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Html\Form\TvShowForm;
use Html\WebPage;

$webPage = new WebPage();

$webPage->appendCssUrl('../css/style.css');
$webPage->setTitle("Ajouter/Modifier");
$webPage->appendContent("<h1>Ajouter/Modifier</h1>");

try {
    $tvshow = null;
    if (isset($_GET["artistId"]) && ctype_digit($_GET["artistId"])) {
        $tvshow = TvShowCollection::findByTvShowId((int)$_GET["artistId"]);
    }

    $artisteForm = new TvShowForm($tvshow);
    $form = $artisteForm->getHtmlForm("save-form.php");

    $webPage->appendContent($form);

    echo $webPage->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}



