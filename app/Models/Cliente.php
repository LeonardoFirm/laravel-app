<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sobrenome',
        'telefone',
        'celular',
        'cpf_cnpj',
        'endereco',
        'bairro',
        'numero',
        'cidade',
        'cep',
        'uf',
    ];

    public function getFormattedCpfCnpjAttribute()
    {
        $cpfCnpj = $this->cpf_cnpj;

        if (strlen($cpfCnpj) == 11) {
            // Formata CPF
            return substr($cpfCnpj, 0, 3) . '.***.***-' . substr($cpfCnpj, -2);
        } elseif (strlen($cpfCnpj) == 14) {
            return substr($cpfCnpj, 0, 2) . '.***.***-**';
        }

        return $cpfCnpj;
    }

    public function getFormattedTelefoneAttribute()
    {
        $telefone = $this->telefone;

        $telefone = preg_replace('/\D/', '', $telefone);

        if (strlen($telefone) == 10) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6);
        } elseif (strlen($telefone) == 11) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
        }

        return $telefone;
    }

    public function getFormattedCelularAttribute()
    {
        $celular = $this->celular;

        $celular = preg_replace('/\D/', '', $celular);

        if (strlen($celular) == 11) {
            return '(' . substr($celular, 0, 2) . ') ' . substr($celular, 2, 5) . '-' . substr($celular, 7);
        }

        return $celular;
    }
}
