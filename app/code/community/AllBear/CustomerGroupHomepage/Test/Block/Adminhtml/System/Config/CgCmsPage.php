<?php

class AllBear_CustomerGroupHomepage_Test_Block_Adminhtml_System_Config_CgCmsPage
    extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     */
    public function toHtmlRenderCorrectOutput()
    {
        $block = $this->_getBlock();

        $html = $block->toHtml();

        //TODO
    }

    protected function _getBlock()
    {
        return Mage::app()->getLayout()
            ->createBlock('allbear_cghomepage/adminhtml_system_config_cgCmsPage');
    }
}