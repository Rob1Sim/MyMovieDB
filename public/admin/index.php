<?php

declare(strict_types=1);

use Html\WebPage;

$webPage = new WebPage();

$webPage->appendCssUrl('../css/style.css');

$page = <<<HTML
    
    <header class="header__admin">
        <h1>Panel d'édition</h1>
    </header>
    <main>
        <div class="admin__btn__container">
            <div class="admin__btn" onclick="location.href='';">
                <h3>Ajout / Edition</h3>
            </div>
        </div>
    </main>    

HTML;


$webPage->appendContent($page);


echo $webPage->toHTML();