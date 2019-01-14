<?php
$username = 'admin';
$password = 'mumma';

$random1 = 'LURVjF5H6!e08wf!7pQZrlcK2HuWSb2Wdo7WPu4@i@%c&Ktist';
$random2 = 'FQAvwhoFGF1M!Cs*fG!ZWxV*o%&hrKFCmx*T8MTsnOwdkJzED3';
$hash = md5($random1.$pass.$random2); 

$self = $_SERVER['REQUEST_URI'];