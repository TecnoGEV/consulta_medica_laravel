<?php 

declare(strict_types=1);

namespace App\Traits;

trait ValidaCPF 
{

    public function trataCpf($cpf) {
        return intval($cpf);
    }
}