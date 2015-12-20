<?php

class AllBear_CustomerGroupHomepage_Block_Adminhtml_System_Config_Form_Field_CmsPage
    extends Mage_Core_Block_Html_Select
{
    protected $_helper;

    protected function _construct()
    {
        parent::_construct();

        $this->_helper = Mage::helper('allbear_cghomepage');
    }

    public function _toHtml()
    {
        $options = Mage::getSingleton('adminhtml/system_config_source_cms_page')
            ->toOptionArray();

        $this->addOption('', $this->_helper->__('--Use Default CMS Page--'));

        foreach ($options as $option) {
            $this->addOption($option['value'], $option['label']);
        }

        return parent::_toHtml();
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }
}