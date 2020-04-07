
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
    <h1>allegorywriteの分析ページ</h1>
    <a href="user.php">ユーザー分析</a>
    <ul id="gallery" class="gallery">
    <?php
        $instagram_business_id = '17841429861743993';
        $access_token = 'EAADHgQehMtYBABBp7ui8ZAcKWWZCdN6oufZArm5T0dZC5zPZAuZCJUGsNPrIZBN1TIfkjsOaHmma0TzdKrfIVmgBZAFbPJMknZAuZBknq4MJQneVnKcdTa5e5RbZA0D5QHOAWurd2eYNZAovIz1WTqRxDfOaXN8gZBhbPMQ8U70jPiKRyRMUQrePtPAM1';
        $target_user = 'allegorywrite';

        $query = 'fields=business_discovery.username('.$target_user.'){id,followers_count,media_count,ig_id,media{caption,media_url,media_type,like_count,comments_count,timestamp,id}}';

        //自分のアカウントの画像が取得できればOKな場合は$queryを以下のようにしてください。

        //$query = 'name,media{caption,like_count,media_url,permalink,timestamp,username}&access_token='.$access_token;

        $instagram_api_url = 'https://graph.facebook.com/v5.0/';
        $target_url = $instagram_api_url.$instagram_business_id."?".$query."&access_token=".$access_token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $instagram_data = curl_exec($ch);
        curl_close($ch);

        $instagram_data = json_decode($instagram_data);

        $gallery_data = $instagram_data->business_discovery->media->data;
        $photos = "";
        $photo_length = count($gallery_data);

        for($i = 0; $i < $photo_length ;$i++){
            $src = $gallery_data[$i]->media_url;
            $id = $gallery_data[$i]->id;
            $photos .= '<li class="gallery-item"><a href="media.php?id='.$id.'&src='.$src.'"><img class="media" src=' . $src . '></a></li>';
        }

        echo $photos;
    ?>
    </ul>
</body>
</html>
