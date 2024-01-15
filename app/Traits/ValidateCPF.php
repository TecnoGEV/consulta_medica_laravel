<?php

declare(strict_types=1);

namespace App\Traits;

trait ValidateCPF
{
    public function cpf_invalid($cpf): bool
    {
        return $this->cpf_with_str($cpf) || strlen($cpf)  !== 11;
    }

    private function cpf_with_str($cpf): bool
    {
        return preg_match('/[a-zA-Z]/', $cpf) === 1;
    }
}
