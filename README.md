### Api for making a bet

Make a post request on /api/bet to use this api.

Correct input structure:

{
    "player_id": 4,
    "stake_amount": "5",
    "selections": [
        {
            "id": 1,
            "odds": "1.601"
        }
    ]
}

Response should be "{}" with status of 201.
