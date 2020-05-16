<?php

namespace App\Traits;

/**
 * Class UserAttribute.
 */
trait UserAttribute
{
     /**
     * @return string
     */
    public function getShowButtonAttribute($class)
    {
        return '<a class="'.$class.'" href="'.route('user.show', $this).'">
                    <i data-toggle="tooltip" data-placement="top" title="View" class="fa fa-eye"></i>
                </a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute($class)
    {
        return '<a class="'.$class.'" href="'.route('user.edit', $this).'">
                    <i data-toggle="tooltip" data-placement="top" title="Edit" class="fa fa-pencil"></i>
                </a>';
    }

    public function getChangePasswordButtonAttribute($class)
    {
        if (access()->user()->id == $this->id && access()->allow('edit-user')) {
        // if (access()->allow('edit-user')) {
            return '<a class="'.$class.'" href="'.route('user.change-password', $this).'">
                        <i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Change Password"></i>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($class)
    {
        // if (auth()->user()->roles[0]->slug == 'admin' && auth()->user()->id != $this->id) {
        if (auth()->user()->roles[0]->slug == 'admin' && access()->id() != $this->id && $this->id != 1){
            $name = $class == '' ? 'Delete' : '';

            return '<a class="'.$class.'" href="'.route('user.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="Cancel"
                 data-trans-button-confirm="Delete"
                 data-trans-title="Are you sure you want to do this?"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i>'.$name.'</a>';
        }

        return '';
    }

     /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {

        return '<div class="btn-group action-btn">
                    '.$this->getShowButtonAttribute('btn btn-default btn-flat').'
                    '.$this->getEditButtonAttribute('btn btn-default btn-flat').'
                    '.$this->getChangePasswordButtonAttribute('btn btn-default btn-flat').'
                    '.$this->getDeleteButtonAttribute('btn btn-default btn-flat').'
                </div>';
        // return '<div class="btn-group action-btn">
        //             '.$this->getShowButtonAttribute('btn btn-default btn-flat').'
        //         </div>';
    }
}