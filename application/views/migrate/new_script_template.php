<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: new_script_template.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 09 Oct 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $descriptive_name
 */
$version_number = $this->datetime_helper->now('YmdHis');
$filename = $version_number . "_" . strtolower($descriptive_name);
header("Content-Type: application/php");
header("Content-Disposition: attachment; filename=" . $filename . ".php");
header("Pragma: no-cache");
header("Expires: 0");
$newline = "\n";
$tab = "\t";
$emptyline = $tab . $newline;

echo "<?php defined('BASEPATH') OR exit('No direct script access allowed');" . $newline;
#region File Header
echo "/**********************************************************************************" . $newline;
echo $tab . "- File Info -" . $newline;
echo $tab . $tab . "File name" . $tab . $tab . ": " . $filename . ".php" . $newline;
echo $tab . $tab . "Author(s)" . $tab . $tab . ": DAVINA Leong Shi Yun" . $newline;
echo $tab . $tab . "Date Created" . $tab . ": " . $this->datetime_helper->today('d M Y') . $newline;
echo $emptyline;
echo $tab . "- Contact Info -" . $newline;
echo $tab . $tab . "Email" . $tab . ": leong.shi.yun@gmail.com" . $newline;
echo $tab . $tab . "Mobile" . $tab . ": (+65) 9369 3752 [Singapore]" . $newline;
echo $emptyline;
echo "***********************************************************************************/" . $newline;
#endregion

#region Migration Version
echo "/* Migration version: " . $newline;
echo " * " . $this->datetime_helper->now('d M Y, h:iA') . $newline;
echo " * " . $version_number . $newline;
echo " */" . $newline;
#endregion

#region Migration Class
echo "class Migration_" . $descriptive_name . " extends CI_Migration" . $newline;
echo "{" . $newline;
echo $tab . "// Public Functions ----------------------------------------------------------------" . $newline;
echo $tab . "public function up()" . $newline;
echo $tab . "{" . $newline;
echo $tab . $tab . "// create tables" . $newline;
echo $tab . $tab . "//\$this->_generate_users();" . $newline;
echo $tab . "}" . $newline;
echo $emptyline;
echo $tab . "public function down()" . $newline;
echo $tab . "{" . $newline;
echo $tab . $tab . "// drop tables" . $newline;
echo $tab . "}" . $newline;
echo $emptyline;
echo $tab . "// Private Functions ---------------------------------------------------------------" . $newline;
echo $tab . "private function _generate_users()" . $newline;
echo $tab . "{" . $newline;
echo $tab . $tab . "\$this->load->model('User_model');" . $newline;
echo $tab . $tab . "\$user = array(" . $newline;
echo $tab . $tab . $tab . "'username' => 'admin'," . $newline;
echo $tab . $tab . $tab . "'name' => 'Default Admin'," . $newline;
echo $tab . $tab . $tab . "'password_hash' => password_hash('password', PASSWORD_DEFAULT)," . $newline;
echo $tab . $tab . $tab . "'access' => 'A'," . $newline;
echo $tab . $tab . $tab . "'status' => 'Active'" . $newline;
echo $tab . $tab . ");" . $newline;
echo $tab . $tab . "\$this->User_model->insert(\$user);" . $newline;
echo $tab . "}" . $newline;
echo $emptyline;
echo "} " . "// end " . $filename . " class";
#endregion