<?php

namespace App\Models;

use Carbon\Traits\Date;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Data
 *
 * @method static Builder|Data newModelQuery()
 * @method static Builder|Data newQuery()
 * @method static Builder|Data query()
 * @mixin Eloquent
 * @property int id
 * @property string cpf
 * @property bool private
 * @property bool incompleto
 * @property Date data_ultima_compra
 * @property float ticket_medio
 * @property float ticket_ultima_compra
 * @property string loja_mais_frequente
 * @property string loja_ultima_compra
 */
class Data extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'cpf',
        'private',
        'incompleto',
        'data_ultima_compra',
        'ticket_medio',
        'ticket_ultima_compra',
        'loja_mais_frequente',
        'loja_ultima_compra',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cpf' => 'string',
        'private' => 'boolean',
        'incompleto' => 'boolean',
        'data_ultima_compra' => 'date',
        'ticket_medio' => 'float',
        'ticket_ultima_compra' => 'float',
        'loja_mais_frequente' => 'string',
        'loja_ultima_compra' => 'string'
    ];

    /**
     * CPF data processing for set method
     *
     * @param  string  $value
     */
    public function setCpfAttribute(string $value): void
    {
        $this->attributes['cpf'] = str_replace(['.', '-'], ['', ''], $value);
    }

    /**
     * Ticket Medio data processing for set method
     *
     * @param  string|null  $value
     */
    public function setTicketMedioAttribute(?string $value): void
    {
        if (isset($value)) {
            $this->attributes['ticket_medio'] = (float) str_replace(['.', ','], ['', '.'], $value);
        } else {
            $this->attributes['ticket_medio'] = $value;
        }
    }

    /**
     * Ticket Ultima Compra data processing for set method
     *
     * @param  string|null  $value
     */
    public function setTicketUltimaCompraAttribute(?string $value): void
    {
        if (isset($value)) {
            $this->attributes['ticket_ultima_compra'] = (float) str_replace(['.', ','], ['', '.'], $value);
        } else {
            $this->attributes['ticket_ultima_compra'] = $value;
        }
    }

    /**
     * Loja Mais Frequente data processing for set method
     *
     * @param  string|null  $value
     */
    public function setLojaMaisFrequenteAttribute(?string $value): void
    {
        if (isset($value)) {
            $this->attributes['loja_mais_frequente'] = str_replace(['.', '-', '/'], ['', '', ''], $value);
        } else {
            $this->attributes['loja_mais_frequente'] = $value;
        }
    }

    /**
     * Loja Ultima Compra data processing for set method
     *
     * @param  string|null  $value
     */
    public function setLojaUltimaCompraAttribute(?string $value): void
    {
        if (isset($value)) {
            $this->attributes['loja_ultima_compra'] = str_replace(['.', '-', '/'], ['', '', ''], $value);
        } else {
            $this->attributes['loja_mais_frequente'] = $value;
        }
    }
}
