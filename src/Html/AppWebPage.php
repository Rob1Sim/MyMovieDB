<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        $this->appendCssUrl("css/style.css");
    }

    public function toHTML(): string
    {
        $res =  <<<HTML
            <!doctype html>
            <html lang="fr">
                    <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
                    
                    {$this->getHead()}
                    <title>{$this->getTitle()}</title>
                    </head>
                    <body>
                        <header class="header">
                            <h1>{$this->getTitle()}</h1>
                        </header>
                        <div class='content'>
                            {$this->getBody()}
                        </div>
                        <footer class='footer'> 
            HTML;

        $res.="<p> Dernière modification : ".WebPage::getLastModification()."</p>".<<<HTML
                            
                        </footer>
                    </body>
            </html> 
            HTML;
        return $res;
    }
}
