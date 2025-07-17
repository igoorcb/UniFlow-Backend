<?php

namespace App\Domain\Interfaces;

interface AuthRepositoryInterface
{
    public function register($request);
    public function login($request);
}
