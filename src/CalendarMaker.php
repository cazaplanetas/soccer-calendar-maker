<?php

namespace Codehell\SoccerCalendar;


class CalendarMaker{

    protected $list;
    protected $calendar;


    public function __construct(array $teams)
    {
        $this->list = $teams;
        $this->parseList($this->list);
    }
    /**
     * @param array $list
     */
    public function setList(array $list)
    {
        $this->list = $list;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @return mixed
     */
    public function getCalendar()
    {
        $this->create();
        return $this->calendar;
    }

    protected function parseList(array &$list)
    {
        if (count($list) % 2) {
            array_push($list, null);
        }
    }

/*
* Algorithm https://es.wikipedia.org/wiki/Sistema_de_todos_contra_todos
*/
    protected function create()
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

        $this->calendar = array_merge($table, $reversed);
    }
}
//End Of Class
