<?php
declare(strict_types=1);

echo '<h1>iDalgo Test Docker - Start</h1>';

include 'test/docker.php';
echo '<br/>include: OK';

$docker = new test\Docker();
echo '<br/>create class: OK';

echo '<br/>return 2: '.$docker->get(2);
echo '<br/>return 20: '.$docker->get(20);
