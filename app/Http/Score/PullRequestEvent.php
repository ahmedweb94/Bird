<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 9/7/2021
 * Time: 08:12 PM
 */

namespace App\Http\Score;


class PullRequestEvent implements ScoreInterface
{

    public function point()
    {
        return 5;
    }
}
