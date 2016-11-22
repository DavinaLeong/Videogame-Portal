<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Datetime_helper
{
    public function now($format_str='Y-m-d H:i:s')
    {
        $now = new DateTime('now', new DateTimeZone(DATETIMEZONE));
        return $now->format($format_str);
    }

    public function today($format_str='Y-m-d H:i:s')
    {
        $today = new DateTime('today', new DateTimeZone(DATETIMEZONE));
        return $today->format($format_str);
    }

    public function get_date_time($date_str,$time_str)
    {
        /*
        The objective of this method is to ensure that false is returned instead of NOW() when a $date_str or $time_str is false.
        
        date_str: DD-MM-YYYY
        time_str: HH:MM:SS
        */
        if($date_str&&$time_str){
            return new DateTime($date_str." ".$time_str, new DateTimeZone(DATETIMEZONE));
        }else{
            return FALSE;
        }
    }
    
    public function format_date_time_strings($date_str,$time_str)
    {
        /*
        The objective of this method is to breakdown the pieces of date 
        into usable pieces, then stick them back together into the format
        that we can use for the PHP DateTime object.
        
        date_str: DD-MM-YYYY
        time_str: HH : MM : AM/PM
        */
        if($date_str&&$time_str){
            
            $formatted_date_time=$this->format_date_str($date_str)." ".$this->format_time_str($time_str);

            return new DateTime($formatted_date_time, new DateTimeZone(DATETIMEZONE));
        }else{
            return FALSE;
        }
    }
    
    public function format_date_str($date_str)
    {
        if($date_str){
            $date_pieces=explode("-",$date_str);

            $day=$date_pieces[0];
            $month=$date_pieces[1];
            $year=$date_pieces[2];
            
            return $year."-".$month."-".$day;
        }else{
            return FALSE;
        }
    }
    
    public function format_time_str($time_str)
    {
        if($time_str){
            $time_str=str_replace(" ","",$time_str);
            $time_pieces=explode(":",$time_str);

            $hour=$time_pieces[0];
            $minute=$time_pieces[1];
            
            //kinda need to use this to sort out the 24HR issue.
            if($hour==12){
                $hour=$hour-12;
            }
            
            if($time_pieces[2]=="PM"){
                $hour=$hour+12;
            }
            
            return $hour.":".$minute.":00";
        }else{
            return FALSE;
        }
    }
   
} //end Datetime_helper class