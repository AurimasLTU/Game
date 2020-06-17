<?php

namespace App\Http\Controllers;

use App\Constants\Ranges;
use App\Constants\ErrorData;

class ErrorController
{
    function checkForErrors($playerId, $stakeAmount, $selections)
    {
        $allOdds = 1;
        $globalErrors = array();
        $errorSelections = array();

        if ($playerId === null || $stakeAmount === null || $selections === null) {
            if ($playerId === null || $stakeAmount === null) {
                array_push($globalErrors, [
                    'code' => ErrorData::BET_SLIP_MISMATCH['code'],
                    'message' => ErrorData::BET_SLIP_MISMATCH['message']
                ]);
            }

            if ($selections === null) {
                array_push($errorSelections, [
                    'code' => ErrorData::BET_SLIP_MISMATCH['code'],
                    'message' => ErrorData::BET_SLIP_MISMATCH['message']
                ]);
            }

            return response([
                'errors' => $globalErrors,
                'selections' => $errorSelections
            ], 400);
        }

        $playerController = new PlayerController();
        $player = $playerController->checkIfPlayerExistsAndGet($playerId);

        if ($player === false) {
            return response([
                'errors' => [
                    'code' => ErrorData::PLAYER_ALREADY_EXISTS['code'],
                    'message' => ErrorData::PLAYER_ALREADY_EXISTS['message']
                ],
                'selections' => $errorSelections
            ], 400);
        }

        if (($player['balance'] - $stakeAmount) < 0) {
            array_push($globalErrors, [
                'code' => ErrorData::INSUFFICIENT_BALANCE['code'],
                'message' => ErrorData::INSUFFICIENT_BALANCE['message']
            ]);
        }

        if ($this->isLowerThanMaxStakeAmount($stakeAmount) === false) {
            array_push($globalErrors, [
                'code' => ErrorData::MAXIMUM_STAKE_AMOUNT['code'],
                'message' => ErrorData::MAXIMUM_STAKE_AMOUNT['message']
            ]);
        }

        if ($this->isHigherThanMinStakeAmount($stakeAmount) === false) {
            array_push($globalErrors, [
                'code' => ErrorData::MINIMUM_STAKE_AMOUNT['code'],
                'message' => ErrorData::MINIMUM_STAKE_AMOUNT['message']
            ]);
        }

        if ($this->isMinimumNumberOfSelectionsMet($selections) === false) {
            array_push($globalErrors, [
                'code' => ErrorData::MINIMUM_NUMBER_OF_SELECTIONS['code'],
                'message' => ErrorData::MINIMUM_NUMBER_OF_SELECTIONS['message']
            ]);
        }

        if ($this->isMaximumNumberOfSelectionsMet($selections) === false) {
            array_push($globalErrors, [
                'code' => ErrorData::MAXIMUM_NUMBER_OF_SELECTIONS['code'],
                'message' => ErrorData::MAXIMUM_NUMBER_OF_SELECTIONS['message']
            ]);
        }

        foreach ($selections as $selection) {
            $errors = array();

            if (floatval($selection['odds']) === 0) {
                array_push($errors, [
                    'code' => ErrorData::BET_SLIP_MISMATCH['code'],
                    'message' => ErrorData::BET_SLIP_MISMATCH['message']
                ]);
            } else {
                $allOdds = $allOdds * floatval($selection['odds']);

                if (count(array_keys($selections, $selection)) !== 1) {
                    array_push($errors, [
                        'code' => ErrorData::DUPLICATE_SELECTION['code'],
                        'message' => ErrorData::DUPLICATE_SELECTION['message']
                    ]);
                }

                if ($this->isMinimumOddsMet(floatval($selection['odds'])) === false) {
                    array_push($errors, [
                        'code' => ErrorData::MINIMUM_ODDS['code'],
                        'message' => ErrorData::MINIMUM_ODDS['message']
                    ]);
                }

                if ($this->isMaximumOddsMet(floatval($selection['odds'])) === false) {
                    array_push($errors, [
                        'code' => ErrorData::MAXIMUM_ODDS['code'],
                        'message' => ErrorData::MAXIMUM_ODDS['message']
                    ]);
                }
            }
            if (!empty($errors)) {
                array_push($errorSelections, [
                        'id' => $selection['id'],
                        'errors' => $errors
                    ]
                );
            }
        }

        if (($allOdds * $stakeAmount) > Ranges::MAX_WIN_AMOUNT) {
            array_push($globalErrors, [
                'code' => ErrorData::MAXIMUM_WIN_AMOUNT['code'],
                'message' => ErrorData::MAXIMUM_WIN_AMOUNT['message']
            ]);
        }

        if (!empty($globalErrors) || !empty($errorSelections)) {
            return response([
                'errors' => $globalErrors,
                'selections' => $errorSelections
            ], 400);
        }

        return false;
    }

    function isMinimumOddsMet($odds)
    {
        return $odds >= Ranges::MIN_ODDS;
    }

    function isMaximumOddsMet($odds)
    {
        return $odds <= Ranges::MAX_ODDS;
    }

    function isLowerThanMaxStakeAmount($stake)
    {
        return $stake <= Ranges::MAX_AMOUNT;
    }

    function isHigherThanMinStakeAmount($stake)
    {
        return $stake >= Ranges::MIN_AMOUNT;
    }

    function isMinimumNumberOfSelectionsMet($selections)
    {
        return count($selections) >= Ranges::MIN_SELECTIONS;
    }

    function isMaximumNumberOfSelectionsMet($selections)
    {
        return count($selections) <= Ranges::MAX_SELECTIONS;
    }
}
