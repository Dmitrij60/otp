<?php

return array(


    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',  // actionCategory в CatalogController
    'category/([0-9]+)' => 'catalog/category/$1',  // actionCategory в CatalogController

    'user/register' => 'user/register',

    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/restore' => 'user/restorepass',
    'user/regok' => 'user/regok',
    'emailactivation/activation' => 'user/regok1',

    /* 'cabinet/viewItemMessage/([0-9]+)' => 'cabinet/viewItemMessage/$1',
     'cabinet/viewmessage' => 'cabinet/viewMessage',*/
    'cabinet/message' => 'cabinet/message',
    'cabinet/status' => 'cabinet/status',
    'cabinet/vo' => 'cabinet/calcvo',
    'cabinet/order' => 'cabinet/sendOrder',
    'cabinet' => 'cabinet/index',


    /*'admin/viewItemMessage/([0-9]+)' => 'admin/viewItemMessage/$1',
    'admin/answer' => 'admin/answer', 
    'admin/fiz/files/([0-9]+)' => 'admin/viewFileFiz/$1',
    'admin/ur/files/([0-9]+)' => 'admin/viewFileUr/$1',

 	'admin/ur/update/([0-9]+)' => 'admin/UpdateUr/$1',
	'admin/fiz/update/([0-9]+)' => 'admin/UpdateFiz/$1',  
	'admin/ur/page-([0-9]+)' => 'admin/indexur/$1',
	'admin/ur' => 'admin/indexur',
    'admin/fiz/page-([0-9]+)' => 'admin/indexfiz/$1',
	'admin/fiz' => 'admin/indexfiz', 
	

	
	 
	'admin' => 'admin/index',*/


    '' => 'site/index',


);