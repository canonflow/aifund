<?php

namespace App\Enums;

enum LearningType : string {
    case HEBB = 'hebb';
    case PERCEPTRON = 'perceptron';
    case DELTA = 'delta';

    public static function calculate($type, $initialValue, $tables, $function, $learningRate = 0)
    {
//        return [$tables[0][count($tables[0]) - 1], $tables[1][count($tables[0]) - 1], $tables[2][count($tables[0]) - 1]];
        switch ($type) {
            case LearningType::HEBB->value:
                $rows = count($tables);
                $cols = count($tables[0]);
                for ($row = 0; $row < $rows; $row++) {
                    for ($col = 0; $col < $cols - 1; $col++) {
                        $initialValue[$col] = $initialValue[$col] + ($tables[$row][$col] * $tables[$row][$cols - 1]);
                    }
                    // BIAS
                    $initialValue[$cols - 1] = $initialValue[$cols - 1] + $tables[$row][$cols - 1];
                }
                return $initialValue;
            case LearningType::PERCEPTRON:
                $prevValue = $initialValue;


                return $initialValue;
        }
    }
}
