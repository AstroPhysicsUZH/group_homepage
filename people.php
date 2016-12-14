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
 * en/decrypts an email address using rotN method
 * (let js then decrypt it afterwards, using -N)
 * 
 * use my own de/encryption, based on the idea of rot13
 */
function encrypt($s, $n=0) {
    static $letters = 'VR@qkxofaHjQ.PJlsuZrOEA_nCTUpcDSWhzygKBYXetNvLwdGMb-mIFi';
    $nchr = strlen($letters);
    $n = (((int)$n) + $nchr) % $nchr;
    $rep = substr($letters, $n) . substr($letters, 0, $n);
    return strtr($s, $letters, $rep);
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
    function cmp_by_last($a, $b) {
        return strnatcmp($a['last'], $b['last']);
    }
    
    if (($handle = fopen("people/" . $filename, "r")) !== FALSE) {

        # get rid of the first $offset lines
        for (;$offset>0;$offset--){$data = fgetcsv($handle);}

        while (($d = fgetcsv($handle)) !== FALSE) {
			
			#print $d;
            
            # check if name field was full, otherwise skip his empty line
            if ($d[2]) {

                $d2 = array(
                    'title'=>$d[0],
                    'first'=>$d[1],
                    'last' => ($d[2]),
                    'func' =>$d[4],
                    'foto' =>$d[7],
                    'mail' =>$d[8],
                    'hp'   =>$d[9],
                    'buro' =>$d[10],
                    'tel'  =>$d[11],
                    
                    'jdate'=>$d[5], # join date used for sorting
                    'ldate'=>$d[6] # leave date used for sorting
                    ) ;
                $people[$d[3]][] = $d2;
            }
        }
        fclose($handle);
        
        # sort $people by their join date $jdate
        foreach ($people as $group => &$members) {
            usort($members, 'cmp_by_last');
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
        $str .= "    <img class=\"floatimg\" src=\"" . gett("people/",$p['foto'], "anon.jpg") . "\">\n";
        $str .= "    <p>";
        $str .= $p['func'] ? "({$p['func']})<br>" : "" ;
        
        $str .= $p['hp'] ? "<a href='{$p['hp']}'>Homepage</a> " : "" ;

        
        if ($p['hp'] and $p['mail']) {
            $str .= " | ";
        }
        /* encrypt email adresses, let js decrypt them */
        $encr_adr = encrypt($p['mail'], 21);
        $str .= $p['mail'] ? "<a class='iimeil' href='mailto:someone@inter.net?body=Please enable javascript to decrypt email adresses. Alternativly you can try http://www.phonebook.uzh.ch/.' data-iimeil='{$encr_adr}' title='email address'>eMail</a><br>" : "" ;

        $str .= $p['buro'] ? "Office: {$p['buro']}<br>" : "" ;
        $str .= $p['tel'] ? "<a href='tel:" . preg_replace('/\s+/', '', $p['tel']) .  "'>Phone: {$p['tel']}</a><br>" : "" ;

        $str .= "</p>\n";
        $str .= "</div>\n";
        
        echo $str;
    }

}

$people = read_csv();
#print_r($people);

?>