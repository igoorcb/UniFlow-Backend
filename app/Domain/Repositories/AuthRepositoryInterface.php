<?php

namespace App\Domain\Repositories;

interface AuthRepositoryInterface
{
    public function register($request);
    public function login($request);
}
