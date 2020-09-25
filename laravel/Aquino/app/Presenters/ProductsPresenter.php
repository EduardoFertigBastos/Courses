<?php

namespace App\Presenters;

use App\Transformers\ProductsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProductsPresenter.
 *
 * @package namespace App\Presenters;
 */
class ProductsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductsTransformer();
    }
}
