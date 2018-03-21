
<?php
if(isset($js))addJavaScript($js);
if(isset($css)) addCss($css);
function addJavaScript($list){
    if($list==null||count($list)==0) return;
    foreach($list as $item){
        foreach ($item[0] as $k => $v) {
            echo '<script src="'. $item[1]. $v.'.js"></script>';
        }
    }
}

function addCss($list){
    if($list==null||count($list)==0) return;
    foreach ($list as $item) {
        foreach ($item[0] as $k => $v) {
            echo '<link rel="stylesheet"  href="' . $item[1] . $v . '.css"/>';
        }
    }
}
//$vx=[js=>[[[],'path1'],[[],'path2']]];