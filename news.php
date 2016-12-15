<?php

$newsdir = './news';
$newsitems = array_diff(scandir($newsdir), array('..', '.'));

$NEWS = [];
foreach ($newsitems as $newsitem) {
    include $newsdir . '/' . $newsitem;
}

function cmp_by_date($a, $b) { return $a['date'] > $b['date']; }
usort($NEWS,"cmp_by_date");

function get_news() {
    global $NEWS;
    foreach ($NEWS as $i) {
        #var_dump($i);

        $class = ($i['isImportant'] ? 'important' : '');

        $now     = new DateTimeImmutable('now');
        $date    = new DateTimeImmutable($i['date']);
        $d_start = (array_key_exists('dateOn' , $i) ? new DateTime($i['dateOn'])  : $now );
        $d_end   = (array_key_exists('dateOff', $i) ? new DateTime($i['dateOff']) : $date->add(new DateInterval('P14D')) );

        #var_dump($date);
        #var_dump($d_start);
        #var_dump($d_end);

        if ($now < $d_start or $now > $d_end) { continue; }

        echo <<<HTML

<li class="{$class}">
    <div class="newsitem">
        <strong>{$i['title']}</strong>
        <br />

{$i['text']}

    </div>
</li>

HTML;
    }
}


?>
