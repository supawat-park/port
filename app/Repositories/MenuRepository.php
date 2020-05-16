<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Menus;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuRepository.
 */
class MenuRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Menu::class;

    /**
     * @param \App\Models\Menu\Menu $menu
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(Menus $menu, array $input)
    {
        if ($menu->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this Menu. Please try again.');
    }
}