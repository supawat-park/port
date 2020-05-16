<?php

namespace App\Traits;

/**
 * Class PermissionAttribute.
 */
trait PermissionAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-permission', 'permission.edit').'
                    '.$this->getDeleteButtonAttribute('delete-permission', 'permission.destroy').'
                </div>';
    }
}