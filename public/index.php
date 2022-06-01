<?php
declare(strict_types=1);

use Entity\Collection\TvShowCollection;
use Html\WebPage;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle("Series TV");

$webPage->appendContent("<div class='list' id='list__serie'>");

foreach (TvShowCollection::findAll() as $show) {
    $idShow = $show->getId();
    $webPage->appendContent("<div class='serie'  onclick=\"location.href='season.php?seasonId=$idShow';\" ><div class='serie__image'><img src='poster.php?posterId=".$show->getPosterId()."' alt='poster de la série'></div> <div class='serie__txt'><h3>".WebPage::escapeString("{$show->getName()}")."</h3><p>".$show->getOverview()."</p></div></div>");
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();
