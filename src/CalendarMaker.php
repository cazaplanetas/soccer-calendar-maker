<?php

namespace Codehell\SoccerCalendar;


class CalendarMaker{

    private $list;

    public function set($teams)
    {
        $this->list = $teams;
    }
    public function get()
    {
        return $this->list;
    }

/*
* Algorithm https://es.wikipedia.org/wiki/Sistema_de_todos_contra_todos
*/
    public function create()
    {
        $teams = $this->list;
        
        /*
         * First Round
         */

        $cols = count($teams);
        $rows = $cols/2;
        $table = array();
        $pivot = array_pop($teams);
		$invte = array_reverse($teams);

       for($i = 1;$i < $cols; $i++)
        {
            for($j= 1;$j <= $rows; $j++)
            {
                if($j == 1){
                    if($i%2){
                        $table[$i][$j] = [current($teams), $pivot];
                    }
                    else{
                        $table[$i][$j] = [$pivot, current($teams)];
                    }
                    if( ! next($teams)) reset($teams);
                }
                else{
                    $table[$i][$j] = [current($teams), current($invte)];
                    if( ! next($teams)) reset($teams);
                    if( ! next($invte)) reset($invte);
                }
            }

        }

        /*
         * Second Round
         */

        $reversed = $table;
        
        foreach ($reversed as &$row)
        {
            foreach ($row as &$r)
            {
                $r = array_reverse($r);
            }

            unset($r);
        }
        unset($row);

        $total = array_merge($table, $reversed);
        
        return $total;
    }
}
//End Of Class
