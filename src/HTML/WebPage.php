<?php

namespace HTML;

use DateTime;
use PhpCsFixer\Diff\Exception;

class WebPage
{
    use StringEscaper;

    private string $head = "";
    private string $title = "";
    private string $body = "";

    public function __construct(string $title = "")
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Ajoute du contenue au Head
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content)
    {
        $this->head .= $content;
    }

    /**
     * Ajoute du css dans le fichier
     * @param string $css
     * @return void
     */
    public function appendCss(string $css)
    {
        //TODO: Ajouter le css
        $this->head .= "<style>$css</style>";
    }

    /**
     * Ajoute un lien vers un fichier css
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url)
    {
        $this->head .= "<link href='$url' rel='stylesheet'>";
    }

    /**
     * Ajoute du javascript
     * @param string $js
     * @return void
     */
    public function appendJs(string $js)
    {
        $this->head .= "<script type='text/javascript'>$js</script>";
    }

    /**
     * Ajoute le liens vers un script
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url)
    {
        $this->head .= "<script type='text/javascript' src='$url'></script>";
    }

    /**
     * Ajoute du contenue dans le body
     * @param string $content
     * @return void
     */
    public function appendContent(string $content)
    {
        $this->body .= $content;
    }

    /**
     * Génère la page web final
     * @return string
     */
    public function toHTML(): string
    {
        return <<<HTML
            <!doctype html>
            <html lang="fr">
                    <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

                    $this->head
                    <title>$this->title</title>
                    </head>
                    <body>
                        $this->body
                    </body>
            </html> 
            HTML;
    }

    /**
     * Renvoie la dernière date de modification du fichier
     * @return string
     */
    public static function getLastModification(): string
    {
        $lastDate = getlastmod();
        return date("d/m/y - H:i:s ", $lastDate);
    }
}
