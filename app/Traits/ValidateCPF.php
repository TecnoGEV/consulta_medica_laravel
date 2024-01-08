<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;

trait ValidateCPF
{
    public function cpf_invalid($cpf): string
    {

        if ($this->cpf_with_str($cpf) || strlen($cpf)  !== 11) {
            throw new Exception("Cpf invalido");
        }

        return $cpf;
    }

    private function cpf_with_str($cpf): bool
    {
        return preg_match('/[a-zA-Z]/', $cpf) === 1;
    }
}
