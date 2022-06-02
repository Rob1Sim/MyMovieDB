<?php

declare(strict_types=1);

use Html\WebPage;

$webPage = new WebPage();

$webPage->appendCssUrl('../css/style.css');




$webPage->appendContent();


echo $webPage->toHTML();