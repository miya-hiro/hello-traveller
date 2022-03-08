console.log('weather用jsココカラ');

$(function () {
  $('[name = "destination"]').on('change', function () {
    var destination = $(this).val();
    // console.log('changeイベント');
    // console.log(destination);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      url: '/get-ajax',
      type: 'GET',
      data: {
        'destination': destination
      },
      dataType: 'json',
    })
      .done(function (response) {
        // console.log("success");
        console.log(response);

        //
        //ここから天気処理
        //
        var $weatherWrap = $('#js_weatherWrap')
        $weatherWrap.html(""); //前回の取得内容をリセット
        // console.log('天気ここから');
        // console.log($weatherWrap);

        var block = '<div class="col">'
          + '<p>今日のお天気：' + response.weather.weather + '</p>'
          + '<p><img src="https://openweathermap.org/img/wn/' + response.weather.icon + '@2x.png"></p>'
          + '</div>';
        // console.log(block);
        $weatherWrap.append(block);


        //
        //ここからtweet処理
        //

        //
        //天気
        //
        var $tweetWeatherWrap = $('#js_tweetWeatherWrap')
        // console.log($tweetWrap.html());

        $tweetWeatherWrap.html(""); //前回の取得内容をリセット

        $.each(response.tweetWeatherList, function (index, tweet) {

          // console.log(tweet);
          // console.log(tweet.mediaUrl);

          // if (tweet.mediaUrl) {
          //   // console.log('あるよ');
          //   var image = tweet.mediaUrl;
          // } else {
          //   // console.log('ないよ');
          //   image = '';
          // }

          var block = '<div class="col">'
            + '<a href="https://twitter.com/' + tweet.user.screen_name + '/status/' + tweet.id_str + '" class="test-dark" target="_blank">'
            // + '<p>アイコン：<img src="' + tweet.user.profile_image_url_https + '"></p>'
            + '<p>画像：<img src="' + tweet.mediaUrl + '" class="img-fluid"></p>'
            + '<p>ツイート内容：' + tweet.full_text + '</p></a>'
            + '</div>';

          // console.log(block);

          $tweetWeatherWrap.append(block);


        }) //each１つめここまで

        //
        //食べ物
        //
        var $tweetFoodWrap = $('#js_tweetFoodWrap')
        // console.log($tweetWrap.html());

        $tweetFoodWrap.html(""); //前回の取得内容をリセット

        $.each(response.tweetFoodList, function (index, tweet) {

          // if (tweet.mediaUrl) {
          //   // console.log('aるよ');
          //   var image = tweet.mediaUrl;
          // } else {
          //   // console.log('ないよ');
          //   image = '';
          // }

          var block = '<div class="col">'
            + '<a href="https://twitter.com/' + tweet.user.screen_name + '/status/' + tweet.id_str + '" class="test-dark" target="_blank">'
            // + '<p>アイコン：<img src="' + tweet.user.profile_image_url_https + '"></p>'
            + '<p>画像：<img src="' + tweet.mediaUrl + '" class="img-fluid"></p>'
            + '<p>ツイート内容：' + tweet.full_text + '</p></a>'
            + '</div>';

          // console.log(block);

          $tweetFoodWrap.append(block);

        }) //each２つめここまで
      })
      .fail(function () {
        console.log("failed");
      })
  }); //changeイベントここまで
})