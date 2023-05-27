<?php

function render($filename, $data)
{
    @mkdir("cache");
    $cache_filename = "cache/" . basename($filename) . "_". rand(1000000, 9999999) . ".php";
    $obj = $data;
    $file_data = file_get_contents("templates/{$filename}");
    $out_data = preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $file_data);
    $out_data = '<?php ob_start(); $s1 = ob_get_contents(); ?>'. "\n $out_data" . '<?php $RETURNVALUE_STRING = ob_get_contents(); ob_end_clean(); ?>';
    file_put_contents($cache_filename,  $out_data);
    require $cache_filename;
    unlink($cache_filename);
    return $RETURNVALUE_STRING;
}
