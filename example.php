<?php

require_once __DIR__.'/autoload.php';

$gc = new \Dlinkgc\GarbageCollector();


$urls = array(
     'http://megaupload.com/?d=VWS948CM',
     'http://www.filesonic.fr/file/cmVytjV',
    'http://www.fileserve.com/file/r6Rf7CC',
    'http://www.gigaup.fr/?g=KKITYJ3KOS',
    'http://uptobox.com/4bw9nm9bjdyq',
    'http://6s1gd1.1fichier.com/',
    'http://www.fufox.net/?d=565E5082A449',
    'http://www.uploadhere.com/FAVLC874ZQ',
    'http://www.uploadking.com/ATN4DCRST2',
    'http://depositfiles.com/files/2rxil4n6x',
    'https://rs546dt.rapidshare.com/#!download|546tl2|4503463114|Hereafter.FRENCH.BDRiP.REPACK.1CD.XViD-AUDELA-Top-Film.Net.avi|735234|R~420BCBBB0489F5B835742B0E361CDB61|0|0',
    'http://www.multiupload.com/ONJH5AOAFU',
    'http://hotfile.com/dl/108028551/4e9b6c8/TF.DVDRip.rar.html',
    'http://hotfile.com/dl/71871556/991642b/Kalafina_-_Kagayaku_Sora_no_Shijima_ni_wa_%28DVD_x264_FLAC%29-Bakazooka.mkv.html',
    'http://uploading.com/files/b693164d/Solomon.Kane.2010.TRUEFRENCH.DVDRIP.XVID.avi/',
    'http://www.filejungle.com/f/gfwzQq/Incepcja.2010.DVDRip.Lektor.PL.avi',
    // '',
    // '',
    // 
);
$urls = array_merge($urls, $urls, $urls);
$ts = microtime(true);

$links = $gc->collect($urls);

$mem = memory_get_usage(true);

foreach($links as $url => $link) {
        $hs = $link->getCrawler()->getResponse()->getStatusCode();

        printf("%s:%s %s [%s] %s \n", $link->getStatus(), $hs, $link->getDetector(), $url,
            $link->getCrawler()->getRequest()->getMethod()
        );
}

$elapsed = microtime(true) - $ts;
printf("\n\nTime: %s ms\n", round($elapsed*1000));

function convert($size)
 {
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
 }

$mempeak = memory_get_peak_usage(true);

printf("Memory: %s\nMemory peak: %s\n", convert($mem), convert($mempeak));


