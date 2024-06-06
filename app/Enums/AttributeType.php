<?php

namespace App\Enums;

enum AttributeType : string {
    case TABLE = 'table';
    case WEIGHT = 'wight';
    case BIAS = 'bias';
    case LEARNING_RATE = 'learning_rate';
    case THRESHOLD = 'threshold';
}
