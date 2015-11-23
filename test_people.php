


top

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/main.js"></script>

<script>

$(function() {
    $('.iimeil').one('click hover mousenter mouseover focus', function(){
        $(this).attr("href", "mailto:"+mach_mini_iimeil_laesbar($(this).data('iimeil')));
    });
});

</script>


<?php include 'people.php'; ?>

middle<br>

<?php
// echo '<a href="#" data-iimeiladi="'.encrypt('test@email.ch', 21) . '">[email]</a>';

$p = array('mail'=>'ABC@abc.ch');
$p = array('mail'=>'jetzer@physik.uzh.ch');
$str = '';
$encr_adr = encrypt($p['mail'], 21);
$str .= $p['mail'] ? "<a class='iimeil' href='#' data-iimeil='{$encr_adr}'>[ hover {$encr_adr} ]</a><br>" : "" ;
echo $str;

?>

<br>end