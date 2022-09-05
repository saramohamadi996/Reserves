<?php

namespace Gym\Reserve\Repositories\Interfaces;

use Gym\Reserve\Models\Reserve;
use Gym\User\Models\User;

interface CartRepositoryInterface
{
    public function cart($value, Reserve $reserve);

    public function destroy($id);
}
