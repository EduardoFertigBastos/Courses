<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Products;

/**
 * Class ProductsTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProductsTransformer extends TransformerAbstract
{
    /**
     * Transform the Products entity.
     *
     * @param \App\Entities\Products $model
     *
     * @return array
     */
    public function transform(Products $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
