<?php

declare(strict_types=1);

use HTML\AppWebPage;
use Entity\Collection\TvShowCollection;
use HTML\WebPage;

$webPage = new AppWebPage();
$webPage->setTitle("Series TV");

$webPage->appendContent("<div class='list'>");

foreach (TvShowCollection::findAll() as $show) {
    $webPage->appendContent("<div class='serie'><a href='season.php?seasonId='".$show->getId()."><div class='serie__image'></div> <div class='serie__txt'> <h3>".WebPage::escapeString("{$show->getName()}")."</h3><p>".$show->getOverview()."</p></div></a></div><br/>");
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();
