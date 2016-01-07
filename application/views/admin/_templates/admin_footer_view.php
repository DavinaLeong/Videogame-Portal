<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: admin_footer_view.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<div id="footer">
    <hr/>
	<?php date_default_timezone_set(DATETIMEZONE); ?>
    <?=SITE_NAME?> &copy; <?=AUTHOR?>, <?=date("Y")?>
</div>
