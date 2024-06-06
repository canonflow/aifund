<?php

namespace App\Enums;

enum ActivationFunction : string {
    case BINARY_HARD = 'binary_hard';
    case BINARY_THRESH = 'binary_thresh';
    case BIPOLAR_HARD = 'bipolar_hard';
    case BIPOLAR_THRESH = 'bipolar_thresh';

    public static function exportFunction($type, $threshold = 0)
    {
        $func = null;
        switch ($type) {
            case ActivationFunction::BINARY_HARD:
                $func = function ($net) {
                    return ($net <= 0) ? 0 : 1;
                };
                break;
            case ActivationFunction::BINARY_THRESH:
                $func = function ($net) use ($threshold) {
                    return ($net < $threshold) ? 0 : 1;
                };
                break;
            case ActivationFunction::BIPOLAR_HARD:
                $func = function ($net) {
                    return ($net < 0) ? -1 : (($net == 0) ? 0 : 1);
                };
                break;
            case ActivationFunction::BIPOLAR_THRESH:
                $func = function ($net) use ($threshold){
                    return ($net < $threshold) ? -1 : 1;
                };
                break;
        }

        return $func;
    }
}
