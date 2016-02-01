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

/**
 * @property CI_DB_driver $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 *
 * @property Datetime_helper $datetime_helper
 */

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

    public function valid_date_check($str)
    {
        $this->load->library('datetime_helper');
        if (preg_match('/\d{2}-\d{2}-\d{4}/', $str))
        {
            if ($datetime = new DateTime($this->datetime_helper->format_date_str($str), new DateTimeZone(DATETIMEZONE)))
            {
                //show_error($datetime->format('d-m-Y'));
                if ($datetime->format('d-m-Y') !== $str)
                {
                    $this->form_validation->set_message('valid_date_check', 'Event Date invalid.');
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
            else
            {
                $this->form_validation->set_message('valid_date_check', 'Event Date invalid.');
                return FALSE;
            }
        }
        else
        {
            $this->form_validation->set_message('valid_date_check', 'Event Date invalid.');
            return FALSE;
        }
    }

} //end Common_functions class
