<?php

namespace App\Filter;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function transform($item): array
    {
        if (isset($item['permission']) && !auth() -> user() -> is_admin) {
            $item['restricted'] = true;
        }

        return $item;
    }
}
