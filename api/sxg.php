<?php
/**
凤凰中文,https://live.goodiptv.club/api/sxg.php?id=test1_4000
凤凰资讯,https://live.goodiptv.club/api/sxg.php?id=test2_4000

CCTV-16 奥林匹克 4K,https://live.goodiptv.club/api/sxg.php?id=CCTV-16-4K_8000
CCTV-17 农业农村,https://live.goodiptv.club/api/sxg.php?id=CCTV-17_4000
CCTV-4K 超高清,https://live.goodiptv.club/api/sxg.php?id=ys4Kcq_2000
4K超高清电影 4K,https://live.goodiptv.club/api/sxg.php?id=emdy4k_8000
欢笑剧场4K,https://live.goodiptv.club/api/sxg.php?id=hxjc-4k_8000
CHC动作电影,https://live.goodiptv.club/api/sxg.php?id=wqCHCdzdyH265_4000
CHC高清电影,https://live.goodiptv.club/api/sxg.php?id=lnwsCHC-HDH265_4000
CHC家庭影院,https://live.goodiptv.club/api/sxg.php?id=jbtygqCHCjtyyH265_4000
动漫秀场,https://live.goodiptv.club/api/sxg.php?id=yybb-dmxc-H265_4000
*/

date_default_timezone_set("Asia/Shanghai");
$channel = empty($_GET['id']) ? "emdy4k_8000" : trim($_GET['id']);
$array = explode("_", $channel);
if (isset($array[1])) {
    $stream = "http://[2409:8c02:21c:60::2b]/live2.rxip.sc96655.com/live/8ne5i_sccn,{$array[0]}_hls_pull_{$array[1]}K/";
} else {
    $stream = "http://[2409:8c02:21c:60::2b]/live2.rxip.sc96655.com/live/8ne5i_sccn,{$array[0]}_hls_pull_4000K/";
}
$timestamp = intval((time() - 60) / 6);
$current = "#EXTM3U" . PHP_EOL;
$current .= "#EXT-X-VERSION:3" . PHP_EOL;
$current .= "#EXT-X-TARGETDURATION:6" . PHP_EOL;
$current .= "#EXT-X-MEDIA-SEQUENCE:{$timestamp}" . PHP_EOL;
for ($i = 0; $i < 6; $i++) {
    $current .= "#EXTINF:6," . PHP_EOL;
    $current .= $stream . rtrim(chunk_split($timestamp, 3, "/"), "/") . ".ts" . PHP_EOL;
    $timestamp = $timestamp + 1;
}
header("Content-Type: application/vnd.apple.mpegurl");
header("Content-Disposition: attachment; filename=index.m3u8");
echo $current;
