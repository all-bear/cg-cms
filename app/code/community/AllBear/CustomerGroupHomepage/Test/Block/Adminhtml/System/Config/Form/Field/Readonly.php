<?php

class AllBear_CustomerGroupHomepage_Test_Block_Adminhtml_System_Config_Form_Field_Readonly
    extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @dataProvider dataProvider
     */
    public function toHtmlRenderCorrectOutput($inputName, $columnName, $class, $style, $size)
    {
        $block = $this->_getBlock($inputName, $columnName, $class, $style, $size);

        $html = $block->toHtml();

        $this->assertStringStartsWith('<input', $html);
        $this->assertContains('readonly="readonly"', $html);
    }

    protected function _getBlock($inputName, $columnName, $class, $style, $size)
    {
        return Mage::app()->getLayout()
            ->createBlock('allbear_cghomepage/adminhtml_system_config_form_field_readonly')
            ->setColumn(array(
                'size'  => $size,
                'class' => $class,
                'style' => $style
            ))->setInputName($inputName)
            ->setColumnName($columnName);
    }
}