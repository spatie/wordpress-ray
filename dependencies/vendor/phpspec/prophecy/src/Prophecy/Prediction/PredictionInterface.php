<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Spatie\WordPressRay\Prophecy\Prediction;

use Spatie\WordPressRay\Prophecy\Call\Call;
use Spatie\WordPressRay\Prophecy\Prophecy\ObjectProphecy;
use Spatie\WordPressRay\Prophecy\Prophecy\MethodProphecy;
/**
 * Prediction interface.
 * Predictions are logical test blocks, tied to `should...` keyword.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface PredictionInterface
{
    /**
     * Tests that double fulfilled prediction.
     *
     * @param Call[]        $calls
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     *
     * @throws object
     * @return void
     */
    public function check(array $calls, ObjectProphecy $object, MethodProphecy $method);
}
