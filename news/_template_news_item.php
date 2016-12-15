<?php

$NEWS[] = [
    "title"       => <<<EOLHTML

<!-- put html text of title in here -->
title
<!-- end html text of title -->

EOLHTML
    , // !!! keep this on a seperate line

    // will make the news apear in red
    "isImportant" => true,

    // when it happens (for sorting)
    "date"     => "2016-09-09 09:00",

    // when will it appear on the webpage, default to 'now', so will
    // be shown imediately
    #"dateOn"   => "2016-09-09 09:00",

    // when will it disappear from webpage, default date+1w
    #"dateOff"  => "2016-09-09 09:00",

    "text"     => <<<EOLHTML

<!-- put html text of body in here -->
Here is a very nice html text
<!-- end html text of body -->

EOLHTML
    ]; // !!! keep this on a seperate line


?>
