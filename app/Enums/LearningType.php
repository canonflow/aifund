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
            case LearningType::PERCEPTRON->value:
                $prevValue = $initialValue;
                $rows = count($tables);
                $cols = count($tables[0]);
                $isStop = false;
                $cnt = 0;  // Batas Looping

                while (!$isStop || $cnt < 100) {
                    for ($row = 0; $row < $rows; $row++) {
                        // Hitung NET
                        $net = $initialValue[$cols - 1];
                        $target = $tables[$row][$cols - 1];
                        $targets[] = $target;
                        for ($col = 0; $col < $cols - 1; $col++) {
                            $net += $tables[$row][$col] * $initialValue[$col];
                        }

                        // Hitung Output dengan Activation Function
                        $y = $function($net);

                        // Kalo gk sama (Target != Output)
                        if ($target != $y) {
                            for ($col = 0; $col < $cols - 1; $col++) {
                                $initialValue[$col] = $initialValue[$col] + ($tables[$row][$col] * $tables[$row][$cols - 1] * $learningRate);
                            }

                            // Bias
                            $initialValue[$cols - 1] = $initialValue[$cols - 1] + ($tables[$row][$cols - 1] * $learningRate);
                        }

                    }

                    if ($prevValue == $initialValue && $cnt != 0) {
                        // Kalo udah Konvergen (iterasi pertama diabaikan waktu pengecekan)
                        $isStop = true;
                        break;
                    } else {
                        $prevValue = $initialValue;
                        $cnt++;
                    }
                }
                return $prevValue;
            case LearningType::DELTA->value:
                $prevValue = $initialValue;
                $rows = count($tables);
                $cols = count($tables[0]);
                $isStop = false;
                $cnt = 0;  // Batas Looping

                while (!$isStop || $cnt < 100) {
                    for ($row = 0; $row < $rows; $row++) {
                        // Hitung NET
                        $net = $initialValue[$cols - 1];
                        $target = $tables[$row][$cols - 1];
                        for ($col = 0; $col < $cols - 1; $col++) {
                            $net += $tables[$row][$col] * $initialValue[$col];
                        }

                        // Hitung Output dengan Activation Function
                        $y = $function($net);

                        // Kalo gk sama (Target != Output)
                        if ($target != $y) {
                            for ($col = 0; $col < $cols - 1; $col++) {
                                $initialValue[$col] = $initialValue[$col] + ($tables[$row][$col] * ($tables[$row][$cols - 1] - $y) * $learningRate);
                            }

                            // Bias
                            $initialValue[$cols - 1] = $initialValue[$cols - 1] + (($tables[$row][$cols - 1] - $y) * $learningRate);
                        }

                    }

                    if ($prevValue == $initialValue && $cnt != 0) {
                        // Kalo udah Konvergen (iterasi pertama diabaikan waktu pengecekan)
                        $isStop = true;
                        break;
                    } else {
                        $prevValue = $initialValue;
                        $cnt++;
                    }
                }
                return $prevValue;
            default:
                return $initialValue;
        }
    }
}
