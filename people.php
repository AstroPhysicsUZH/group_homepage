<?php
/*
 * This script parses the csv table people/people.csv for the people section
 * 
 * On load, it parses the data and stores it into an array, afterwards
 * the echo only output the arrays
 * 
 */


/**
 * set language to utf8 such that the csv files work properly
 */
header("Content-Type: text/html; charset=utf-8");
setlocale(LC_ALL, 'us_US.UTF-8');


/**
 * small helper, similar to python array.get(default_value)
 */
function get(&$var, $default="") {
    return isset($var) ? $var : $default;
}
function gett($pf="", &$var, $default="") {
    return $pf . ($var ? $var : $default);
}


/**
 * reads a cvs file
 * $offset:   how many lines to ignore at the beginning of the csv file
 * 
 * will put persons into categories (from col 3)
 * will sort by the (string) date in col 5
 */
function read_csv($filename="people.csv",$offset=3) {
    $row=0;
    #$people = array();
    
    function cmp_by_date($a, $b) {
        return strnatcmp($a['jdate'], $b['jdate']);
    }
    
    if (($handle = fopen("people/" . $filename, "r")) !== FALSE) {

        # get rid of the first $offset lines
        for (;$offset>0;$offset--){$data = fgetcsv($handle);}

        while (($d = fgetcsv($handle)) !== FALSE) {
            
            # check if name field was full, otherwise skip his empty line
            if ($d[2]) {

                $d2 = array(
                    'title'=>$d[0],
                    'first'=>$d[1],
                    'last' => ($d[2]),
                    'func' =>$d[4],
                    'foto' =>$d[6],
                    'mail' =>$d[7],
                    'hp'   =>$d[8],
                    'buro' =>$d[9],
                    'tel'  =>$d[10],
                    
                    'jdate'=>$d[5] # used for sorting
                    ) ;
                $people[$d[3]][] = $d2;
            }
        }
        fclose($handle);
        
        # sort $people by their join date $jdate
        foreach ($people as $group => &$members) {
            usort($members, 'cmp_by_date');
            #$people[$group] = $members;
        }
        
        return $people;
    }
    else {
        return FALSE;
    }
}




function get_people($filter) {
    
    global $people;

    foreach ($people[$filter] as $p) {
        $str  = "<div class=\"adressblock clearfix\">\n";
        $str .= "    <h3>" . get($p['title'], '') . " {$p['first']} {$p['last']}</h3>\n"; #mind the space before first
        $str .= "    <img class=\"floatimg\" src=\"" . gett("",$p['foto'], "people/anon.jpg") . "\">\n";
        $str .= "    <p>";
        $str .= $p['func'] ? "({$p['func']})<br>" : "" ;
        
        $str .= $p['hp'] ? "<a href='{$p['hp']}'>Homepage</a><br>" : "" ;
        $str .= $p['mail'] ? "Email: <a href='mailto:{$p['mail']}'>{$p['mail']}</a><br>" : "" ;
        #$str .= "Email: " . ( $p['mail'] ? "<a href='mailto:{$p['mail']}'>{$p['mail']}</a>" : "(none)" ) . "<br>";
        $str .= $p['buro'] ? "Office: {$p['buro']}<br>" : "" ;
        #$str .= gett("Office: ", $p['buro'], "(none)") . "<br>";
        $str .= $p['tel'] ? "Phone: {$p['tel']}<br>" : "" ;
        #$str .= gett("Tel: ", $p['tel'], "(none)");
        $str .= "</p>\n";
        $str .= "</div>\n";
        
        echo $str;
    }

}

$people = read_csv();
#print_r($people);

?>