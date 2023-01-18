<?php
declare(strict_types=1);

namespace App\Interfaces;


use App\Models\User;
use Illuminate\Support\Collection;

interface GenreRepositoryInterface {

    public function getGenreByName(array|string $nameList);
    public function assignGenreToUser(Collection|array $ids, User $user);
}