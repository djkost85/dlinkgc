<?php

require_once __DIR__.'/autoload.php';

$gc = new \Dlinkgc\GarbageCollector();


$urls = array(
     /*'http://megaupload.com/?d=VWS948CM',
     'http://www.filesonic.fr/file/cmVytjV',
    'http://www.fileserve.com/file/xxrmncg',
    'http://www.gigaup.fr/?g=KKITYJ3KOS',
    'http://uptobox.com/4bw9nm9bjdyq',
    'http://6s1gd1.1fichier.com/',
    'http://www.fufox.net/?d=565E5082A449',
    'http://www.uploadhere.com/FAVLC874ZQ',
    'http://www.uploadking.com/ATN4DCRST2',
    'http://depositfiles.com/files/2rxil4n6x',*/
    'http://rs546dt.rapidshare.com/#!download|546tl2|450346311|Hereafter.FRENCH.BDRiP.REPACK.1CD.XViD-AUDELA-Top-Film.Net.avi|735234|R~420BCBBB0489F5B835742B0E361CDB61|0|0',
    // '',
    // '',
    // '',
    // '',
    // '',
    // '',
    // 
);
$ts = microtime(true);

$links = $gc->collect($urls);



foreach($links as $url => $link) {
        $hs = $link->getCrawler()->getResponse()->getStatusCode();
        printf("[%s] %s:%s  filehoster: %s | method: %s \n", $url, $link->getStatus(), $hs, $link->getDetector(),
            $link->getCrawler()->getRequest()->getMethod()
        );
}


$elapsed = microtime(true) - $ts;
printf("\n\nTime: %s ms\n", round($elapsed*1000));

