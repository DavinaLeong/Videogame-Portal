<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Common_functions.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
***********************************************************************************/

class Common_functions
{
    public function _error_not_implemented($func_name)
    {
        show_error("<b>" . $func_name . "</b> not implementd.");
    }

    public function _error_not_implemented_dialogue($func_name, $error = "Error Name")
    {
        echo "<div style='margin: 10px; padding: 10px; border: thin solid #600; background-color: #fee; border-radius: 5px; font-family: consolas, \"Courier New\", monotype'>" .
                "\t<h4 style='color: darkRed;'>" . $error . ":</h4>" .
                "\t<p><strong style='color: darkRed;'>" . $func_name . "</strong> not implemented.</p>" .
            "</div>";
    }

    public function _do_var_dump($var, $var_name = "Variable Name")
    {
        echo "<div style='margin: 10px; padding: 10px; border: thin solid #ccc; background-color: #eee; border-radius: 5px; font-family: consolas, \"Courier New\", monotype'>" .
                "<h4>var_dump - (<strong style='color: #009;'>" . $var_name . "</strong>):</h4>";
        var_dump($var);
        echo "</div>";
    }

    public function _do_var_export($var, $var_name = "Variable Name", $start_tag = "<p>", $end_tag = "</p>")
    {
        echo "<div style='margin: 10px; padding: 10px; border: thin solid #ccc; background-color: #eee; border-radius: 5px;'>" .
                "<h4>var_export - (<strong style='color: #009;". $var_name . "</strong>):</h4>" . $start_tag;
        var_export($var);
        echo $end_tag . "</div>";
    }

} //end Common_functions class
