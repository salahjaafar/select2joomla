<?php

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\System\PluginBase;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Asset\AssetHelper;

class PlgSystemSelect2joomla extends PluginBase
{
    public function onBeforeCompileHead()
    {
        $this->addSelect2Assets();
    }

    private function addSelect2Assets()
    {
        $document = Factory::getDocument();
        $useCdn = $this->params->get('use_cdn', 1);

        $version = new Version([5, 0, 0]); // Update with actual Joomla 5 version when available

        // jQuery UI.js
        $jqueryUiJsPath = $useCdn
            ? AssetHelper::getAssetUrl('vendor/jquery-ui/' . $version . '/jquery-ui.min.js')
            : Uri::root(true) . '/plugins/system/select2joomla/assets/jquery-ui.min.js';
        $document->addScript($jqueryUiJsPath);

        // jQuery UI.css
        $jqueryUiCssPath = $useCdn
            ? AssetHelper::getAssetUrl('vendor/jquery-ui/' . $version . '/themes/base/jquery-ui.min.css')
            : Uri::root(true) . '/plugins/system/select2joomla/assets/jquery-ui.min.css';
        $document->addStyleSheet($jqueryUiCssPath);

        // Select2 JavaScript
        $jsPath = $useCdn
            ? 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            : Uri::root(true) . '/plugins/system/select2joomla/assets/select2.min.js';
        $document->addScript($jsPath);

        // Select2 CSS
        $cssPath = $useCdn
            ? 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            : Uri::root(true) . '/plugins/system/select2joomla/assets/select2.min.css';
        $document->addStyleSheet($cssPath);
    }
}
