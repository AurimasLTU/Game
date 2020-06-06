<?php

namespace App\Constants;

class Error {
    const UNKNOWN_ERROR = ['code' => '0', 'message' => 'Unknown error'];
    const BET_SLIP_MISMATCH = ['code' => '1', 'message' => 'Bet slip mismatch'];
    const MINIMUM_STAKE_AMOUNT = ['code' => '2', 'message' => 'Minimum stake amount is ' . Ranges::MIN_AMOUNT];
    const MAXIMUM_STAKE_AMOUNT = ['code' => '3', 'message' => 'Maximum stake amount is ' . Ranges::MAX_COUNT];
    const MINIMUM_NUMBER_OF_SELECTIONS = ['code' => '4', 'message' => 'Minimum number of selections is ' . Ranges::MIN_SELECTIONS];
    const MAXIMUM_NUMBER_OF_SELECTIONS = ['code' => '5', 'message' => 'Maximum number of selections is ' . Ranges::MAX_SELECTIONS];
    const MINIMUM_ODDS = ['code' => '6', 'message' => 'Minimum odds are ' . Ranges::MIN_ODDS];
    const MAXIMUM_ODDS = ['code' => '7', 'message' => 'Maximum odds are ' . Ranges::MAX_ODDS];
    const DUPLICATE_SELECTION = ['code' => '8', 'message' => 'Duplicate selections found'];
    const MAXIMUM_WIN_AMOUNT = ['code' => '9', 'message' => 'Maximum win amount is ' . Ranges::MAX_WIN_AMOUNT];
    const PREVIOUS_ACTION_NOT_FINISHED = ['code' => '10', 'message' => 'Previous action is not finished yet'];
    const INSUFFICIENT_BALANCE = ['code' => '11', 'message' => 'Insufficient balance'];
}
