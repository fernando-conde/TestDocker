<?php
declare(strict_types=1);

echo '<h1>iDalgo Test Docker - Start</h1>';

include 'docker/Start.php';

echo '<br/>include: OK';

$docker = new source\docker\Start();

echo '<br/>create class: OK';

echo '<br/>return 2: '.$docker->get(2);
echo '<br/>return 20: '.$docker->get(20);

echo __DIR__;
