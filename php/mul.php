<style>
    body{
        background-color: #eef;
    }
    table, th, td {
        border: 1px solid black;
    }

    table {
        width: 100%;
        background-color: #ffe;
    }

    td {
        font-size: 30px;
    }
</style>

<?php


function randStr($length = 6)
{
    $string = 'ABCDEF0123456789';
    $result = [
        'font' => '',
        'background' => ''
    ];
    for ($a = 1; $a <= $length; $a++) {
        $result['background'] .= $string[rand(0, strlen($string) - 1)];
    }
    $result['font'] = dechex(hexdec('ffffff') - hexdec($result['background']));
    return $result;
}

$str = '';
$str .= '<table border="1" cellpadding="10" cellspacing="10">';
for ($i = 1; $i <= 9; $i++) {
    $str .= '<tr>';
    for ($j = 1; $j <= 9; $j++) {
        if ($j > $i) {
            continue;
        }
        $color = randStr();
        $background = '#' . $color['background'];
        $font = '#' . $color['font'];
        $str .= "<td style='background-color: $background; color: $font;'>";
        $str .= $j . '*' . $i . '=' . $i * $j;
        $str .= '</td>';
    }
    $str .= '</tr>';
}
$str .= '</table>';

echo $str;