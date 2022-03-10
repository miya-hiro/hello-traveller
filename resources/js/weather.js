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
      url: '/api/weather',
      type: 'GET',
      data: {
        'destination': destination
      },
      dataType: 'json',
    })
      .done(function (response) {
        // console.log("success");
        console.log(response);

        var $weatherWrap = $('#js_weatherWrap')
        $weatherWrap.html(""); //前回の取得内容をリセット
        // console.log('天気ここから');
        // console.log($weatherWrap);

        var block = '<div class="col">'
          + '<p>今のお天気：' + response.data + '</p>'
          + '<p><img src="https://openweathermap.org/img/wn/' + response.icon + '@2x.png"></p>'
          + '</div>';
        // console.log(block);
        $weatherWrap.append(block);

      })
      .fail(function () {
        console.log("failed");
      })


    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      url: '/api/tweets',
      type: 'GET',
      data: {
        'destination': destination
      },
      dataType: 'json',
    })
      .done(function (response) {
        // console.log("success");

        const makeTweetHtml = function (index, tweet) {

          var block = '<div class="col">'
            + '<a href="https://twitter.com/' + tweet.user.screen_name + '/status/' + tweet.id_str + '" class="test-dark" target="_blank">'
            + '<p>画像：<img src="' + tweet.mediaUrl + '" class="img-fluid"></p>'
            + '<p>ツイート内容：' + tweet.full_text + '</p></a>'
            + '</div>';

          targetDom.append(block);
        }

        //
        //天気
        //
        var targetDom = $('#js_tweetWeatherWrap')
        targetDom.html(""); //前回の取得内容をリセット
        $.each(response.weather, makeTweetHtml) //each１つめここまで

        //
        //食べ物
        //
        var targetDom = $('#js_tweetFoodWrap')
        targetDom.html(""); //前回の取得内容をリセット
        $.each(response.food, makeTweetHtml) //each１つめここまで

      })
      .fail(function () {
        console.log("failed");
      })
  }); //changeイベントここまで
})