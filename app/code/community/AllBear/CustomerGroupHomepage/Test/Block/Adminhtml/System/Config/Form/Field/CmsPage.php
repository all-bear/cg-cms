<?php

class AllBear_CustomerGroupHomepage_Test_Block_Adminhtml_System_Config_Form_Field_CmsPage
    extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @dataProvider dataProvider
     */
    public function toHtmlRenderCorrectOutput($inputName, $columnName)
    {
        $block = $this->_getBlock($inputName, $columnName);

        $html = $block->toHtml();

        $this->assertStringStartsWith('<select', $html);

        $options = Mage::getSingleton('adminhtml/system_config_source_cms_page')
            ->toOptionArray();

        foreach ($options as $option) {
            $this->assertContains('<option value="' . $option['value'] . '"', $html);
        }
    }

    protected function _getBlock($inputName, $columnName)
    {
        return Mage::app()->getLayout()
            ->createBlock('allbear_cghomepage/adminhtml_system_config_form_field_cmsPage')
            ->setInputName($inputName)
            ->setColumnName($columnName);
    }
}