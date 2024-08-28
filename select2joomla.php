<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;

class PlgSystemSelect2joomla extends CMSPlugin
{
    protected $autoloadLanguage = true;

    public function onBeforeCompileHead()
    {
        $app = Factory::getApplication();
        
        // Ne charger que dans l'interface administrateur ou sur le site frontal selon vos besoins
        if ($app->isClient('administrator') || $app->isClient('site')) {
            $this->addSelect2Assets();
        }
    }

    private function addSelect2Assets()
    {
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
        $useCdn = $this->params->get('use_cdn', 1);

        // Enregistrer jQuery UI
        $jqueryUiJsPath = $useCdn
            ? 'https://code.jquery.com/ui/1.13.2/jquery-ui.min.js'
            : Uri::root(true) . '/plugins/system/select2joomla/assets/jquery-ui.min.js';
        $jqueryUiCssPath = $useCdn
            ? 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css'
            : Uri::root(true) . '/plugins/system/select2joomla/assets/jquery-ui.min.css';
        
        $wa->registerAndUseScript('jquery.ui', $jqueryUiJsPath, [], ['defer' => true]);
        $wa->registerAndUseStyle('jquery.ui', $jqueryUiCssPath);

        // Enregistrer Select2
        $select2JsPath = $useCdn
            ? 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            : Uri::root(true) . '/plugins/system/select2joomla/assets/select2.min.js';
        $select2CssPath = $useCdn
            ? 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            : Uri::root(true) . '/plugins/system/select2joomla/assets/select2.min.css';
        
        $wa->registerAndUseScript('select2', $select2JsPath, ['jquery', 'jquery.ui'], ['defer' => true]);
        $wa->registerAndUseStyle('select2', $select2CssPath);

        // Initialiser Select2 de manière sûre
        $wa->addInlineScript('
            document.addEventListener("DOMContentLoaded", function() {
                if (typeof jQuery !== "undefined" && typeof jQuery.fn.select2 !== "undefined") {
                    // Initialiser Select2 ici si nécessaire
                    // Par exemple : jQuery(".select2-class").select2();
                }
            });
        ');
    }
}
