<?php

/*master batches*/
$router->map('POST', '/master/batch/create', 'App\Controllers\BatchController@create', 'create_batch');

?>