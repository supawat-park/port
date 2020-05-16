<?php

namespace App\Http\Responses\Admin\User;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\Access\User\User
     */
    protected $user;

    /**
     * @param \App\Models\Access\User\User $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * In Response.
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('admin.users.show')->withUser($this->user);
    }
}
