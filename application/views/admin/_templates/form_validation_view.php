<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: form_validation_view.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>
	<?php if(validation_errors()):?>
		<div class="alert alert-danger" role="alert">
			<div class="row">
				<div class="col-sm-1" style="width: 2%;"><<i class="fa fa-exclamation-triangle"></i></div>
				<div class="col-sm-10"><?=validation_errors();?></div>
				<div class="col-sm-1 pull-right"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button></div>
			</div>
		</div>
	<?php endif;?>
