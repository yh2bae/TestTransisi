<?php  

function handle()
{
    $arr = [
        ['f', 'g', 'h', 'i'],
        ['j', 'k', 'p', 'q'],
        ['r', 's', 't', 'u'],
    ];

    $input = 'fghi';

    $param1 = str_split($input);
    $found = false;

    foreach ($arr as $key => $value) {
        $result = array_diff($param1, $value);
        if ($result) {
            $found = true;
            break;
        };
    }

    var_dump($result, $found);
}

echo handle();
?>