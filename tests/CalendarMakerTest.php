<?php

use Codehell\SoccerCalendar\CalendarMaker;


class CalendarMakerTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function test_calendar()
    {

        $this->assertTrue($this->trial_calendar());

    }

    /**
     * Compare all matches and check that there are none repeated
     * @return bool
     */
    public static function trial_calendar()
    {
        $reduced = [];
        $calendar = new CalendarMaker([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, null]);

        $result = $calendar->getCalendar();

        /*
         * Reduce array to one level for use with array unique
         */

        foreach ($result as $row)
        {
            foreach ($row as $r)
            {
                $reduced[] = "$r[0], $r[1]";
            }
        }

        $unique = array_unique($reduced);

        return count($reduced) == count($unique);
    }

}