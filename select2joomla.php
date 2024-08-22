<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;

class PlgSystemSelect2joomla extends CMSPlugin
{
    public function onBeforeCompileHead()
    {
        // Vérifie si l'application actuelle est le site (frontend)
        if (!$this->isFrontend()) {
            return;
        }

        $this->addSelect2Assets();
    }

    private function isFrontend()
    {
        $app = Factory::getApplication();
        return $app->isClient('site'); // Vérifie si c'est le frontend
    }

    private function addSelect2Assets()
    {
        $document = Factory::getDocument();
        $useCdn = $this->params->get('use_cdn', 1);

        // Ajoute jQuery
        $document->addScript('https://code.jquery.com/jquery-3.6.0.min.js', ['type' => 'text/javascript', 'defer' => true]);

        // jQuery UI.js
        $jqueryUiJsPath = $useCdn
            ? 'https://code.jquery.com/ui/1.13.2/jquery-ui.min.js'
            : Uri::root() . 'plugins/system/select2joomla/assets/jquery-ui.min.js';
        $document->addScript($jqueryUiJsPath, ['type' => 'text/javascript', 'defer' => true]);

        // jQuery UI.css
        $jqueryUiCssPath = $useCdn
            ? 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css'
            : Uri::root() . 'plugins/system/select2joomla/assets/jquery-ui.min.css';
        $document->addStyleSheet($jqueryUiCssPath);

        // Select2 JavaScript
        $jsPath = $useCdn
            ? 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            : Uri::root() . 'plugins/system/select2joomla/assets/select2.min.js';
        $document->addScript($jsPath, ['type' => 'text/javascript', 'defer' => true]);

        // Select2 CSS
        $cssPath = $useCdn
            ? 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            : Uri::root() . 'plugins/system/select2joomla/assets/select2.min.css';
        $document->addStyleSheet($cssPath);
    }
}
