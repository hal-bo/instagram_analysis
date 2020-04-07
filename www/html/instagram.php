<?php

$instagram_business_id = '17841429861743993';
//$access_token = 'EAADHgQehMtYBAErOJpAFwIfoKLWNKoMRRFSZAREK181H4O8L2DgRRsKXHO8hU64RxhZAonFtQ7PtmstKqPbdxfTmai3fLJCRD7ZB7q2m7LUL3n3EUnMXZB3mZBdR5YKDBWriJDbTUs7gsiIBWOz68ma0mnDpQiGe9oYoUXb0zatCCs23qJ0y8';
$access_token = 'EAADHgQehMtYBABBp7ui8ZAcKWWZCdN6oufZArm5T0dZC5zPZAuZCJUGsNPrIZBN1TIfkjsOaHmma0TzdKrfIVmgBZAFbPJMknZAuZBknq4MJQneVnKcdTa5e5RbZA0D5QHOAWurd2eYNZAovIz1WTqRxDfOaXN8gZBhbPMQ8U70jPiKRyRMUQrePtPAM1';
$target_user = 'allegorywrite';

//自分が所有するアカウント以外のInstagramビジネスアカウントが投稿している写真も取得したい場合は以下
$query = 'business_discovery.username('.$target_user.'){id,followers_count,media_count,ig_id,media{caption,media_url,media_type,like_count,comments_count,timestamp,id}}';

//自分のアカウントの画像が取得できればOKな場合は$queryを以下のようにしてください。

//$query = 'name,media{caption,like_count,media_url,permalink,timestamp,username}&access_token='.$access_token;



$instagram_api_url = 'https://graph.facebook.com/v5.0/';
$target_url = $instagram_api_url.$instagram_business_id."?fields=".$query."&access_token=".$access_token;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$instagram_data = curl_exec($ch);
curl_close($ch);

echo $instagram_data;
exit;