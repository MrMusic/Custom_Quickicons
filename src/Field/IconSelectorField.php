<?php
/*
 *  package: Custom-Quickicons
 *  copyright: Copyright (c) 2024. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 2 or later
 *  link: https://www.joomill-extensions.com
 */

namespace Joomill\Module\Customquickicon\Administrator\Field;

use Joomill\Module\Customquickicon\Administrator\Helper\FontawesomeIconsHelper;
use Joomill\Module\Customquickicon\Administrator\Helper\ModalHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\Language\Text;

// No direct access.
defined('_JEXEC') or die;

class IconSelectorField extends FormField {

    static $icons = array();
    protected $type = 'IconSelector';

    public function getLabel() {
        $label = Text::_('MOD_CUSTOM_QUICKICON_ITEM_ICON_LABEL');
        return $label;
    }

    public function getInput() {
        $value = strlen($this->value) ? $this->value : 'fab fa-joomla';
        $for = $this->id;

        $html = '
            <div class="d-flex">
                <div class="icon-preview">
                    <i data-preview-id="'.$for.'" class="'.$value.'"></i>
                </div>
                <button data-for="'.$for.'" class="modal-open-btn btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#FontawesomeModal">'.Text::_('MOD_CUSTOM_QUICKICON_SELECT_ICON').'</button>
            </div>
            <input class="icon-value-input" type="hidden" data-id="'.$for.'" id="'.$for.'" data-required="false" name="' . $this->name . '" value="' . $value . '" />';
        return $html;
    }

    public static function build($type){
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
        $wa->registerAndUseScript('modalhelper', 'mod_custom_quickicon/modalhelper.js', ['defer' => true], []);
        $wa->registerAndUseStyle('backendCSS', 'mod_custom_quickicon/backend.css', ['relative' => true, 'version' => 'auto'], ['nomodule' => true, 'defer' => true]);

        $html = self::buildModal();
        return $html;
    }

    private static function buildModal(){
        $wa = Factory::getDocument()->getWebAssetManager();
        $wa->useScript('bootstrap.modal');

        self::$icons = FontawesomeIconsHelper::getIcons();

        $html = '
            <div class="modal modal-xl fade" id="FontawesomeModal" tabindex="-1" aria-labelledby="FontawesomeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">'.Text::_('MOD_CUSTOM_QUICKICON_SELECT_ICON').'</h2>
                        </div>
                        <div class="modal-body">
                            '.self::buildHeading().'
                            '.self::buildIconList().'
                        </div>
                        <div class="modal-footer text-right">
                            <button class="modal-close btn btn-default" data-bs-dismiss="modal" type="button">'.Text::_('MOD_CUSTOM_QUICKICON_CLOSE').'</button>
                        </div>
                    </div>
                </div>
            </div>';
        return $html;
    }

    private static function buildHeading(){
        $html = '
        <form id="selectForm" class="">
            <div class="contentpane row">
                <div class="col">
                    <div class="filter-search-bar btn-group">
                        <div class="input-group">
                            <input name="icon-search" class="form-control" type="text" placeholder="'.Text::_('MOD_CUSTOM_QUICKICON_SEARCH').'" id="icon-search-input">
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <small class="form-text">'.Text::_('MOD_CUSTOM_QUICKICON_NUMBER_OF_ICONS').': '.count(self::$icons).'</small>
                </div>     
                <div class="col text-end">
                    <small class="form-text">FontAwesome Version: 6.5.1</small>
                </div>     
            </div>
        </form>';
        return $html;
    }

    private static function buildIconList(){
        $html = '
            <div class="contentpane row row-cols-3 row-cols-sm-4 row-cols-lg-6 row-cols-xl-8 iconlist">';
                foreach(self::$icons as $icon){
                    $html .= '
                    <div data-icon-name="'.$icon.'" class="icon col" data-bs-dismiss="modal">
                        <div data-icon-name="'.$icon.'" class="px-3 py-4 mb-2 bg-body-secondary text-center rounded">
                            <i data-icon-name="'.$icon.'" class="'.$icon.'"></i>
                        </div>
                    </div>';
                }
        $html .= '
            </div>';
        return $html;
    }
}