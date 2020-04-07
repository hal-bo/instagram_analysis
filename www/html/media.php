<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>allegorywriteの分析ページ 投稿分析</h1>
    <?php
     $src = $_GET['src'].'&_nc_cat='.$_GET['_nc_cat'].'&_nc_sid='.$_GET['_nc_sid'].'&_nc_ohc='.$_GET['_nc_ohc'].'&_nc_ht='.$_GET['_nc_ht'].'&oh='.$_GET['oh'].'&oe='.$_GET['oe'];
     ?>
    <img width="20%" src=<?= $src ?>>
    <?php

        $instagram_business_id = '17841429861743993';
        $instagram_media_id = $_GET['id'];
        //$access_token = 'EAADHgQehMtYBAErOJpAFwIfoKLWNKoMRRFSZAREK181H4O8L2DgRRsKXHO8hU64RxhZAonFtQ7PtmstKqPbdxfTmai3fLJCRD7ZB7q2m7LUL3n3EUnMXZB3mZBdR5YKDBWriJDbTUs7gsiIBWOz68ma0mnDpQiGe9oYoUXb0zatCCs23qJ0y8';
        $access_token = 'EAADHgQehMtYBABBp7ui8ZAcKWWZCdN6oufZArm5T0dZC5zPZAuZCJUGsNPrIZBN1TIfkjsOaHmma0TzdKrfIVmgBZAFbPJMknZAuZBknq4MJQneVnKcdTa5e5RbZA0D5QHOAWurd2eYNZAovIz1WTqRxDfOaXN8gZBhbPMQ8U70jPiKRyRMUQrePtPAM1';
        $target_user = 'allegorywrite';

        //自分が所有するアカウント以外のInstagramビジネスアカウントが投稿している写真も取得したい場合は以下
        //$query = 'business_discovery.username('.$target_user.'){id,followers_count,media_count,ig_id,media{caption,media_url,media_type,like_count,comments_count,timestamp,id}}';
        $query = 'metric=impressions,reach,engagement,saved';
        //自分のアカウントの画像が取得できればOKな場合は$queryを以下のようにしてください。

        //$query = 'name,media{caption,like_count,media_url,permalink,timestamp,username}&access_token='.$access_token;



        $instagram_api_url = 'https://graph.facebook.com/v5.0/';
        //$target_url = $instagram_api_url.$instagram_business_id."?fields=".$query."&access_token=".$access_token;
        $target_url = $instagram_api_url.$instagram_media_id."/insights?".$query."&access_token=".$access_token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $instagram_data = curl_exec($ch);
        curl_close($ch);

        $instagram_data = json_decode($instagram_data);
        // foreach($instagram_data->data as $data){
        //     echo '<br>';
        //     foreach($data as $key => $value){
        //         echo '<br>';
        //         echo $key . ":" . $value;
        //     }
        // }
        //var_dump($instagram_data->data);
        //$gallery_data = $instagram_data->business_discovery->media->data;
        $photos = "";
        $photo_length = 9;

        for($i = 0; $i < $photo_length ;$i++){
           // $photos .= '<li class="gallery-item"><img src=' . $gallery_data[$i]->media_url . '></li>';
        }

        //echo $photos;
    ?>
    </ul>
    <?php foreach($instagram_data->data as $data): ?>
        <table width="500" cellspacing="0" cellpadding="5" bordercolor="#333333">
        <?php foreach($data as $key => $value): ?>
            <tr>
            <td nowrap><?= $key ?>: </td>
            <td valign="top" width="150">
            <?php if($key == "values"): ?>
                <strong><?= $value[0]->value ?></strong>
            <?php elseif ($key == "name"): ?>
                <strong><?= $value ?></strong>
            <?php else: ?>
                <?= $value ?>
            <?php endif; ?>
            </td>
            </tr>
        <?php endforeach ?>
        </table>
        <br>
    <?php endforeach; ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/script.js"></script> -->
</body>
</html>
