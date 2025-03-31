<?php

class AdminBoxManagerController extends AdminController
{
    public function __construct()
    {
        $this->table = 'box_manager';
        $this->className = 'BoxManager';
        $this->lang = true;
        parent::__construct();
    }

    public function initContent()
    {
        parent::initContent();
    }
}
