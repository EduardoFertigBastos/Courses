<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'instituition_id',
    ];

    public function getTotalValueAttribute()
    {
        return ( 
            $this->movements()->application()->sum('value')
            -
            $this->movements()->outflow()->sum('value')
        );
    }
    
    /*public function getTotalValueAttribute()
    {
        return ( 
            $this->movements()->where('type', 1)->sum('value')
            -
            $this->movements()->where('type', 2)->sum('value')
        );
    }*/

    public function user()
    {
        // Caso o nome da função fosse diferente do nome da tabela, 
        // Ex: Função: Owner, seria necessário passar um segundo parâmetro
        // que seria o id da chave estrangeira.

        return $this->belongsTo(User::class);
    }

    public function instituition()
    {
        return $this->belongsTo(Instituition::class);
    }

    public function users()
    {
        // Relacionamento N:N, segundo Parametro: Nome da tabela
        return $this->belongsToMany(User::class, 'user_groups');
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
    

}
