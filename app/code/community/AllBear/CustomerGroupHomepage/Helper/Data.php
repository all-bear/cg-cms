<?php

class AllBear_CustomerGroupHomepage_Helper_Data extends Mage_Core_Helper_Abstract
{
    const CUSTOMER_GROUP_CMS_HOME_PAGE_CONFIG_PATH = 'web/default/customer_group_cms_home_page';

    protected function _getCurrentCustomerGroupId()
    {
        return Mage::getSingleton('customer/session')->getCustomerGroupId();
    }

    public function getCmsHomePageCode()
    {
        return $this->_getConfigCmsPageCode(self::CUSTOMER_GROUP_CMS_HOME_PAGE_CONFIG_PATH);
    }

    protected function _getConfigCmsPageCode($configPath)
    {
        $configValue = Mage::getStoreConfig($configPath);

        if (!$configValue) {
            return null;
        }

        $customerGroupId = $this->_getCurrentCustomerGroupId();
        $config = unserialize($configValue);
        foreach ($config as $cgData) {
            if ($cgData['customer_group_id'] == $customerGroupId) {
                return $cgData['cms_page_code'];
            }
        }

        return null;
    }
}