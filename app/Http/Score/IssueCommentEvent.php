<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 9/7/2021
 * Time: 08:12 PM
 */

namespace App\Http\Score;


class IssueCommentEvent implements ScoreInterface
{

    public function point()
    {
        return 4;
    }
}
