<?php

use yii\helpers\VarDumper;

//if (!function_exists('dump')) {
//    /**
//     * @param       $var
//     * @param array $moreVars
//     *
//     * @return array
//     */
//    function dump($var, ...$moreVars) {
//        VarDumper::dump($var);
//
//        foreach ($moreVars as $v) {
//            VarDumper::dump($v);
//        }
//
//        if (1 < func_num_args()) {
//            return func_get_args();
//        }
//
//        return $var;
//    }
//}
//
//if (!function_exists('ddd')) {
//    /**
//     * @param mixed ...$vars
//     */
//    function ddd(...$vars) {
//        foreach ($vars as $v) {
//            VarDumper::dump($v);
//        }
//
//        die(1);
//    }
//}

function varToString($var, $emptyText = '', $prefix = '', $postfix = '') {
    if (empty($var)) {
        return $emptyText;
    }

    return str_replace('%value%', $var, $prefix . (empty($prefix) || !empty($postfix) ? '%value%' : '') . $postfix);
}

function normalizeHtml($html) {
    $html = preg_replace('/<h1[^>]*>(.*)<\/h1>/imsU', '<h2 class="titles-h2 mt25 mb25">$1</h2>', $html);
    $html = preg_replace('/<h2[^>]*>/imsU', '<h2 class="titles-h2 mt25 mb25">', $html);
    $html = preg_replace('/<p[^>]*>/imsU', '<p class="content-p mb5">', $html);
    $html = preg_replace('/\s*style="[^"]+"/imsU', '', $html);
    //$html = str_replace('\n', ', ', $html);

    return $html;
}

/**
 * Обрезает текст с русскими и латинскими словами до нужной длины
 *
 * @param $text
 * @param $num
 *
 * @return string
 */
function crop_text($text, $num) {
    $text = strip_tags($text); #удаляем все html теги
    $text = str_replace('&amp;nbsp;', ' ', $text); #заменяем &amp;nbsp; на пробел
    $text = iconv('utf-8', 'windows-1251', $text); #кодируем в win-1251
    if (strlen($text) > $num) { #strlen считает кол-во символов и, если оно больше      указанного в переменной $num, то режем ее
        $text = substr($text, 0, $num); #функция substr режет текст от 0 до кол-ва символов в переменной $num
        $text = iconv('windows-1251', 'utf-8', $text); #кодируем обратно в utf-8
        $crop = trim($text) . "..."; #убираем пробел, если он остался после резки и   добавляем троеточие
    } else { #а, если у нас количество символов не больше указанного в переменной $num, то мы кодируем обратно в utf-8
        $text = iconv('windows-1251', 'utf-8', $text);
        $crop = $text;
    }

    return $crop;
}

/**
 * Debug function
 *
 * @param mixed  $data
 * @param string $data_name
 */
function d($data, $data_name='$data') {
    $tmp_var = debug_backtrace(1);
    $caller = array_shift($tmp_var);

    error_reporting(-1);
    header('Content-Type: text/html; charset=utf-8');

    echo '<code>File: ' . $caller['file'] . ' / Line: ' . $caller['line'] . '</code>';
    echo '<pre>';
    echo $data_name . '=', PHP_EOL;
    VarDumper::dump($data, 10, true);
    echo '</pre>';
}

function dg($data, $data_name='$data') {
    if (isset($_GET['_dbg'])) {
        $tmp_var = debug_backtrace(1);
        $caller = array_shift($tmp_var);

        error_reporting(-1);
        header('Content-Type: text/html; charset=utf-8');

        echo '<code>File: ' . $caller['file'] . ' / Line: ' . $caller['line'] . '</code>';
        echo '<pre>';
        echo $data_name . '=', PHP_EOL;
        VarDumper::dump($data, 10, true);
        echo '</pre>';
    }
}

/**
 * Debug function with die() after
 *
 * @param        $data
 * @param string $data_name
 */
function dd($data, $data_name='$data') {
    $tmp_var = debug_backtrace(1);
    $caller = array_shift($tmp_var);

    error_reporting(-1);
    header('Content-Type: text/html; charset=utf-8');

    echo '<code>File: ' . $caller['file'] . ' / Line: ' . $caller['line'] . '</code>';
    echo '<pre>';
    echo $data_name . '=', PHP_EOL;
    VarDumper::dump($data, 10, true);
    echo '</pre>';

    die();
}


function ddg($var) {
    dg($var);
    die();
}
//function p($var) {
//    error_reporting(-1);
//    header('Content-Type: text/html; charset=utf-8');
//    echo '<pre>';
//    VarDumper::dump($var, 10, false);
//    echo '</pre>';
//}
//
//function pd($var) {
//    error_reporting(-1);
//    header('Content-Type: text/html; charset=utf-8');
//    echo '<pre>';
//    VarDumper::dump($var, 10, false);
//    echo '</pre>';
//    die();
//}

//function getOS($userAgent) {
//    // Создадим список операционных систем в виде элементов массива
//    $oses = array (
//        'iPhone' => '(iPhone)',
//        'Windows 3.11' => 'Win16',
//        'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', // Используем регулярное выражение
//        'Windows 98' => '(Windows 98)|(Win98)',
//        'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
//        'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
//        'Windows 2003' => '(Windows NT 5.2)',
//        'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
//        'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
//        'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
//        'Windows ME' => 'Windows ME',
//        'Open BSD'=>'OpenBSD',
//        'Sun OS'=>'SunOS',
//        'Linux'=>'(Linux)|(X11)',
//        'Safari' => '(Safari)',
//        'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
//        'QNX'=>'QNX',
//        'BeOS'=>'BeOS',
//        'OS/2'=>'OS/2',
//        'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
//    );
//    foreach ($oses as $os=>$pattern) {
//        if (eregi($pattern, $userAgent)) { // Пройдемся по массиву $oses для поиска соответствующей операционной системы.
//            return $os;
//        }
//    }
//    return 'Unknown'; // Хрен его знает, чего у него на десктопе стоит.
//}

function isJson($string) {
    return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))))) ? true : false;
}
