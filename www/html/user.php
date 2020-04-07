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
    <h1>allegorywriteの分析ページ ユーザー分析</h1>
    <?php

        $instagram_business_id = '17841429861743993';
        $access_token = 'EAADHgQehMtYBABBp7ui8ZAcKWWZCdN6oufZArm5T0dZC5zPZAuZCJUGsNPrIZBN1TIfkjsOaHmma0TzdKrfIVmgBZAFbPJMknZAuZBknq4MJQneVnKcdTa5e5RbZA0D5QHOAWurd2eYNZAovIz1WTqRxDfOaXN8gZBhbPMQ8U70jPiKRyRMUQrePtPAM1';

        $query_day = 'metric=email_contacts,follower_count,get_directions_clicks,reach,impressions,phone_call_clicks,profile_views,text_message_clicks,website_clicks&period=day';
        $query_week = 'metric=impressions,reach&period=week';
        $query_day28 = 'metric=impressions,reach&period=days_28';
        $query_lifetime = 'metric=audience_city,audience_country,audience_gender_age,audience_locale&period=lifetime';

        $instagram_api_url = 'https://graph.facebook.com/v5.0/';

        $target_url['day'] = $instagram_api_url.$instagram_business_id."/insights?".$query_day."&access_token=".$access_token;
        $target_url['week'] = $instagram_api_url.$instagram_business_id."/insights?".$query_week."&access_token=".$access_token;
        $target_url['day28'] = $instagram_api_url.$instagram_business_id."/insights?".$query_day28."&access_token=".$access_token;
        $target_url['lifetime'] = $instagram_api_url.$instagram_business_id."/insights?".$query_lifetime."&access_token=".$access_token;

        $instagram_datas = [];
        foreach($target_url as $period => $url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $instagram_datas[$period] = curl_exec($ch);
            curl_close($ch);

            $instagram_datas[$period] = json_decode($instagram_datas[$period]);
        }
    ?>
    </ul>
    <?php foreach($instagram_datas as $period => $instagram_data): ?>
        <strong><?= $period ?></strong>
        <?php foreach($instagram_data->data as $data): ?>
            <table width="500" cellspacing="0" cellpadding="5" bordercolor="#333333">
            <?php foreach($data as $key => $value): ?>
                <tr>
                <td nowrap><?= $key ?>: </td>
                <td valign="top" width="150">
                <?php if($key == "values"): ?>
                    <? if($period == 'lifetime'): ?>
                        <? foreach($value[0]->value as $i => $j): ?>
                        <?= $i.': <strong>'.$j.'</strong>' ?>
                        <br>
                        <? endforeach; ?>
                    <? else: ?>
                        <? foreach($value as $i => $j): ?>
                        <strong><?= $value[$i]->value ?></strong>
                        <?= $value[$i]->end_time ?>
                        <br>
                        <? endforeach; ?>
                    <? endif; ?>
                <?php elseif ($key == "name"): ?>
                    <strong><?= $value ?></strong>
                <?php else: ?>
                    <?= $value ?>
                <?php endif; ?>
                </td>
                </tr>
            <?php endforeach; ?>
            </table>
            <br>
        <?php endforeach; ?>
        <br>
    <?php endforeach; ?>
</body>
</html>
