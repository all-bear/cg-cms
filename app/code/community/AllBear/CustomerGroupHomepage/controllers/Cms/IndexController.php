<?php

require_once(Mage::getModuleDir('controllers', 'Mage_Cms') . DS . 'IndexController.php');

class AllBear_CustomerGroupHomepage_Cms_IndexController extends Mage_Cms_IndexController
{
    protected $_helper;

    protected function _construct()
    {
        parent::_construct();

        $this->_helper = Mage::helper('allbear_cghomepage');
    }

    public function indexAction($coreRoute = null)
    {
        $pageId = $this->_helper->getCmsHomePageCode();

        if (!$pageId || !Mage::helper('cms/page')->renderPage($this, $pageId)) {
            parent::indexAction($coreRoute);
        }
    }
}