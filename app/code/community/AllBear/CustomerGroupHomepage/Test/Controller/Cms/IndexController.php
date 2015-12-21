<?php

class AllBear_CustomerGroupHomepage_Test_Controller_Cms_IndexController
    extends EcomDev_PHPUnit_Test_Case_Controller
{
    /**
     * Set up controller params
     * (non-PHPdoc)
     * @see EcomDev_PHPUnit_Test_Case::setUp()
     */
    protected function setUp()
    {
        EcomDev_PHPUnit_Test_Case::setUp();

        $this->reset();
        //$this->registerCookieStub(); fix exception
        $this->getCookies()->reset();
        $this->app()->getFrontController()->init();
    }

    /**
     * @loadFixture
     * @dataProvider dataProvider
     * @test
     */
    public function customerGroupCorrectCmsHomepage($customerGroupId)
    {
        Mage::getSingleton('customer/session')->setCustomerGroupId($customerGroupId);

        $this->dispatch('');

        $html = $this->_getCmsPageHtml($this->expected($customerGroupId)->getCmsCode());
        $this->assertResponseBodyContains($html);
    }

    protected function _getCmsPageHtml($pageId)
    {
        $page = Mage::getModel('cms/page')->load($pageId);

        $helper = Mage::helper('cms');
        $processor = $helper->getPageTemplateProcessor();
        $html = $processor->filter($page->getContent());
        return $html;
    }
}
