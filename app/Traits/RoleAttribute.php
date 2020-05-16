<?php

namespace App\Traits;

/**
 * Class RoleAttribute.
 */
trait RoleAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-role')) {
            return '<a class="btn btn-flat btn-default" href="'.route('role.edit', $this).'">
                    <i data-toggle="tooltip" data-placement="top" title="Edit" class="fa fa-pencil"></i>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        //Can't delete master admin role
        if ($this->id != 1 && access()->allow('delete-role')) {
            return '<a class="btn btn-flat btn-default" href="'.route('role.destroy', $this).'" data-method="delete"
                        data-trans-button-cancel="Cancel"
                        data-trans-button-confirm="Delete"
                        data-trans-title="Are you sure you want to do this?">
                            <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                    </a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-role', 'role.edit').'
                    '.$this->getDeleteButtonAttribute().'
                </div>';
    }
}
