<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Products.
 *
 * @package namespace App\Entities;
 */
class Products extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'instituition_id',
        'name',
        'description',
        'index',
        'interest_rate',
    ];

   // protected $table = 'products';

    public function instituition()
    {
        return $this->belongsTo(Instituition::class);
    }

    public function valueFromUser(User $user)
    {
        $inflows = $this->movements()->products($this)->applications()->sum('value');
        $outflows = $this->movements()->products($this)->outflows()->sum('value');

        return $inflows - $outflows;
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
