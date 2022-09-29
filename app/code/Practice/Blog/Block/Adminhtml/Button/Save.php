<?php

namespace Practice\Blog\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save implements ButtonProviderInterface
{

    public function getButtonData()
    {

        return [

            'label' => __('Save Blog'),

            'class' => 'save primary',

            'data_attribute' => [

                'mage-init' => ['button' => ['event' => 'save']],

                'form-role' => 'save',

            ],

            'sort_order' => 90,

        ];
    }
}
