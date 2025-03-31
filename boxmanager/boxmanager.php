<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class BoxManager extends Module
{
    public function __construct()
    {
        $this->name = 'boxmanager';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Twój Sklep';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Box Manager');
        $this->description = $this->l('Moduł do zarządzania boksami na stronie głównej.');

        $this->confirmUninstall = $this->l('Czy na pewno chcesz odinstalować moduł?');
    }

    public function install()
    {
        if (!parent::install() || !Configuration::updateValue('BOX_MANAGER_ENABLED', true)) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }

        return true;
    }

    public function getContent()
    {
        $this->context->controller->addCSS($this->_path . 'views/assets/css/style.css');
        $this->context->controller->addJS($this->_path . 'views/assets/js/script.js');

        $output = '';
        if (Tools::isSubmit('submit_box_manager')) {
            $title = Tools::getValue('BOX_MANAGER_TITLE');
            $url = Tools::getValue('BOX_MANAGER_URL');
            $background = Tools::getValue('BOX_MANAGER_BACKGROUND');

            Configuration::updateValue('BOX_MANAGER_TITLE', $title);
            Configuration::updateValue('BOX_MANAGER_URL', $url);
            Configuration::updateValue('BOX_MANAGER_BACKGROUND', $background);

            $output .= $this->displayConfirmation($this->l('Ustawienia zostały zapisane.'));
        }

        return $output . $this->renderForm();
    }

    public function renderForm()
    {
        $this->context->controller->addJqueryUI('ui-datepicker');

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Ustawienia Box Managera'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Tytuł'),
                        'name' => 'BOX_MANAGER_TITLE',
                        'size' => 50,
                        'required' => true,
                        'value' => Configuration::get('BOX_MANAGER_TITLE'),
                    ),
                    array(
                        'type' => 'file',
                        'label' => $this->l('Wgraj tło boksu'),
                        'name' => 'BOX_MANAGER_BACKGROUND',
                        'display_image' => true,
                        'image' => $this->_path . 'views/img/default-bg.jpg',
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('URL (link do kategorii, produktu, strony)'),
                        'name' => 'BOX_MANAGER_URL',
                        'size' => 255,
                        'required' => true,
                        'value' => Configuration::get('BOX_MANAGER_URL'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Zapisz'),
                    'name' => 'submit_box_manager',
                ),
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = 'module_'.$this->name;
        $helper->submit_action = 'submit_box_manager';
        $helper->fields_value['BOX_MANAGER_TITLE'] = Configuration::get('BOX_MANAGER_TITLE');
        $helper->fields_value['BOX_MANAGER_URL'] = Configuration::get('BOX_MANAGER_URL');
        $helper->fields_value['BOX_MANAGER_BACKGROUND'] = Configuration::get('BOX_MANAGER_BACKGROUND');

        return $helper->generateForm(array($fields_form));
    }

    public function hookDisplayHome($params)
    {
        $this->context->smarty->assign(array(
            'title' => Configuration::get('BOX_MANAGER_TITLE'),
            'url' => Configuration::get('BOX_MANAGER_URL'),
            'background' => Configuration::get('BOX_MANAGER_BACKGROUND'),
        ));

        return $this->display(__FILE__, 'views/templates/front/box.tpl');
    }
}
