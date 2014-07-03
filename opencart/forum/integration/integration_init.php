<?php
/*
* integration pack 2.0
* 
* ## Copyright (c) <2014> <minhaj: polarglow06@gmail.com, minhaj@vimmaniac.com>
* ## https://github.com/minhaj-vimmaniac
* ## http://vimmaniac.com/
* ## under the MIT license
*
*
*
* initializes the integration
*/


include($phpbb_root_path . 'integration/functions_integration.' . $phpEx); //for hunt_easter
##for hunt_easter, hack to simplify session management
session_start();
session_write_close();
## END hack
?>