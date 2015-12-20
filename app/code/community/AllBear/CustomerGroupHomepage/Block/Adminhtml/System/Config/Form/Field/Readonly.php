<?php

class AllBear_CustomerGroupHomepage_Block_Adminhtml_System_Config_Form_Field_Readonly
    extends Mage_Core_Block_Abstract
{
    public function _toHtml()
    {
        $column = $this->getColumn();

        return '<input type="text" name="' . $this->getInputName() . '" value="#{' . $this->getColumnName() . '}" ' .
               'readonly="readonly"' .
               ($column['size'] ? 'size="' . $column['size'] . '"' : '') . ' class="' .
               (isset($column['class']) ? $column['class'] : 'input-text') . '"'.
               (isset($column['style']) ? ' style="'.$column['style'] . '"' : '') . '/>';
    }
}