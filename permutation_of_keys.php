<?php
/* Question Number : 5 */
function telephone_words( $keys_press ) {
    $keys = array (
        1 => array('1'),
        2 => array('2','A','B','C'),
        3 => array('3','D','E','F'),
        4 => array('4','G','H','I'),
        5 => array('5','J','K','L'),
        6 => array('6','M','N','O'),
        7 => array('7','P','Q','R','S'),
        8 => array('8','T','U','V'),
        9 => array('9','W','X','Y','Z'),
        10 => array('*'),
        11 => array('0'),
        12 => array('#')
    );
    
    $temp = [];
    foreach($keys_press as $n => $pkeys ) {
        foreach($keys[$pkeys] as $i => $o) {
            if($i && $n == 0 ) 
            {
                $temp[] = $o;
            }
        }
        
        if($n){
        foreach($temp as $k => $l){
            foreach($keys[$pkeys] as $i => $o) {
                if($i) 
                {
                    $temp[] = $l.$o;
                    unset($temp[$k]);
                }
            }
        }}
    }
    return empty($temp) ? '' : implode(', ',$temp) ;
}

# examples
$output = telephone_words([1,2,3]);
$output = telephone_words([2,2]);
$output = telephone_words([2,3,4,5,6,7,8]);
$output = telephone_words([2,5]); #Pass the numbers here
echo $output;
?>
