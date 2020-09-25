<?php

namespace App\Presenters;

use App\Transformers\MovementTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MovementPresenter.
 *
 * @package namespace App\Presenters;
 */
class MovementPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MovementTransformer();
    }
}
