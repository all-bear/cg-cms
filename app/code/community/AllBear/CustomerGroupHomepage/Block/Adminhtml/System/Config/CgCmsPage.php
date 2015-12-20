<?php

class AllBear_CustomerGroupHomepage_Block_Adminhtml_System_Config_CgCmsPage
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected $_helper;

    protected function _construct()
    {
        parent::_construct();

        $this->setTemplate('allbear/cghomepage/system/config/form/field/static_array.phtml');
        $this->_helper = Mage::helper('allbear_cghomepage');
    }

    protected function _prepareToRender()
    {
        $this->addColumn('customer_group_id', array(
            'label'    => $this->_helper->__('Group ID'),
            'renderer' => $this->_getCustomerGroupIdRenderer(),
            'style'    => 'width: 50px;'
        ));
        $this->addColumn('customer_group_code', array(
            'label'    => $this->_helper->__('Group Code'),
            'renderer' => $this->_getCustomerGroupCodeRenderer()
        ));
        $this->addColumn('cms_page_code', array(
            'label'    => $this->_helper->__('CMS Page'),
            'renderer' => $this->_getCmsPageRenderer()
        ));

        $this->_addAfter       = false;
        $this->_addButtonLabel = $this->_helper->__('Add');
    }

    protected function _getCmsPageRenderer()
    {
        return $this->_getRenderer('CmsPage');
    }

    protected function _getCustomerGroupIdRenderer()
    {
        return $this->_getRenderer('Readonly');
    }

    protected function _getCustomerGroupCodeRenderer()
    {
        return $this->_getRenderer('Readonly');
    }

    private function _getRenderer($rendererName)
    {
        $key = $rendererName;
        if (!$this->hasData($key)) {
            $renderer = $this->getLayout()->createBlock(
                'allbear_cghomepage/adminhtml_system_config_form_field_' . lcfirst($rendererName), '',
                array('is_render_to_js_template' => true)
            );

            $this->setData($key, $renderer);
        }

        return $this->getData($key);
    }

    protected function _getAvailableCustomerGroups()
    {
        return Mage::getResourceModel('customer/group_collection')->addOrder('customer_group_code', 'ASC');
    }

    protected function _getCustomerGroupCmsPageId($customerGroupId)
    {
        $element = $this->getElement();
        if ($element->getValue() && is_array($element->getValue())) {
            foreach ($element->getValue() as $rowId => $row) {
                if ($row['customer_group_id'] == $customerGroupId) {
                    return $row['cms_page_code'];
                }
            }
        }

        return '';
    }

    protected function _prepareRows()
    {
        $element = $this->getElement();
        $value   = array();

        $customerGroups = $this->_getAvailableCustomerGroups();

        foreach ($customerGroups as $customerGroup) {
            $customerGroupCode = $customerGroup->getCustomerGroupCode();
            $customerGroupId   = $customerGroup->getId();
            $cmsPageCode       = $this->_getCustomerGroupCmsPageId($customerGroupId);
            array_push($value, array(
                'customer_group_id'   => $customerGroupId,
                'customer_group_code' => $customerGroupCode,
                'cms_page_code'       => $cmsPageCode
            ));
        }

        $element->setValue($value);
    }

    public function getArrayRows()
    {
        $this->_prepareRows();

        return parent::getArrayRows();
    }

    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getCmsPageRenderer()
                ->calcOptionHash($row->getData('cms_page_code')),
            'selected="selected"'
        );
    }

    public function setElement($element)
    {
        parent::setElement($element);
    }
}