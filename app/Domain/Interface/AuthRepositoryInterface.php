<?php

namespace App\Domain\Interface;

interface AuthRepositoryInterface
{
    public function register($request);
    public function login($request);
}
