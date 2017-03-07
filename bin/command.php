<?php

// php bin/command.php hosts:list
// hosts:list
// hosts:remove <hostname>
// hosts:add <hostname>
// hosts:reload

$options = getopt('', ['action:']);


if (!array_key_exists('action', $options)) {
    print "--action argument not defined \n"; exit;
}


var_dump($options);

