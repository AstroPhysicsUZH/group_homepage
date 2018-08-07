<?php

$NEWS[] = [
    "title"       => <<<HTML
ACES Workshop<br />
Irchel campus, Zurich &ndash; 29/30 June 2017
HTML
    , #keep this on a seperate line

    "isImportant" => false,

    // when it happens (for sorting)
    "date"     => "2017-06-29 00:00",

    // when will it appear on the webpage, default to 'now', so will
    // be shown imediately
    #"dateOn"   => "2016-09-09 09:00",

    // when will it disappear from webpage, default date+1w
    "dateOff"  => "2017-06-30 23:59", # well this function was implemented such that old news won't stay forever on the main page... but apparently we like it there forever. So nice try doing something handy but completly useless... who wants an up to date webpage anyways...

    "text"     => <<<HTML
<a href="http://www.physik.uzh.ch/events/aces2017/">Workshop on fundamental and applied science with clocks and cold atoms in space</a>
HTML
    ]; #keep this on a seperate line


?>
