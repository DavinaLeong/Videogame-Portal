<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: user_message_view.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>
	<?php if($this->session->userdata('message')):?>
		<div class="alert alert-info" role="alert">
            <div class="pull-right"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button></div>
            <p><i class="fa fa-info fa-fw"></i>&nbsp;<?=$this->session->userdata('message')?></p>
		</div>
		<?php $this->session->unset_userdata('message') ?>
	<?php endif;?>
