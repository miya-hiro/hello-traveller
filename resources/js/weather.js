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
      .done(function (tweetList) {
        // console.log("success");
        console.log(tweetList);

        var $tweetWrap = $('#js_tweetWrap')
        console.log($tweetWrap.html());

        $tweetWrap.html(""); //前回の取得内容をリセット

        $.each(tweetList.tweetList, function (index, tweet) {

          // console.log(tweet);
          // console.log(tweet.mediaUrl);

          if (tweet.mediaUrl) {
            console.log('aるよ');
            var image = tweet.mediaUrl;
          } else {
            console.log('ないよ');
            image = '';
          }

          let block = '<div class="col">'
            + '<p>アイコン：<img src="' + tweet.user.profile_image_url_https + '"></p>'
            + '<p>画像：<img src="' + image + '"></p>'
            + '<p>ツイート内容：' + tweet.text + '</p>'
            + '</div>';

          console.log(block);

          $tweetWrap.append(block);
        })

      })

      .fail(function () {
        console.log("failed");
      })
  });
})