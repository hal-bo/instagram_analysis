
axios.get("instagram.php").then(instagram_data=>{
    console.log(instagram_data);// 検証ツールのConsoleを覗くと取得したデータの全容が確認できます。
    //
    //他のInstagramビジネスアカウントの投稿情報も取得したい場合
    const gallery_data = instagram_data["data"]["business_discovery"]["media"]["data"];
    //
    //自分のInstagramビジネスアカウントの投稿情報が取得できればOKな場合は
    //const gallery_dataを下記にする。

    // const gallery_data = instagram_data["data"]["media"]["data"];
    let photos = "";
    const photo_length = 9;

    for(let i = 0; i < photo_length ;i++){
      photos += '<li class="gallery-item"><img src="' + gallery_data[i].media_url + '"></li>';
    }
    document.querySelector("#gallery").innerHTML = photos;
  }).catch(error=>{
    console.log(error);
  })