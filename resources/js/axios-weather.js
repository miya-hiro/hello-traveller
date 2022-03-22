console.log('weather用 axions ココカラ');


new Vue(
  {
    el: '#axios-practice',
    data: {
      selected: '', //初期に選ばれているoption。v-model="selected" と連動
      weather: 'ここにデータが入ります',
      twitterWeathers: 'ここにデータが入ります',
      twitterWeather: '子データです',
      twitterFoods: 'ここにデータが入ります',
      twitterFood: '子データです',
      options: [
        { text: 'Open this select menu', value: '' },
        { text: 'SAPPORO', value: '札幌' },
        { text: 'TOKYO', value: '東京' },
        { text: 'OSAKA', value: '大阪' },
        { text: 'OKINAWA', value: '沖縄' }
      ]
    },
    methods: {
      getData: function () { //!!
        this.getWeather();
        this.getTweets();
      },
      getWeather: function (v) {
        const me = this //!!!!!

        axios(
          {
            method: 'GET',
            url: '/api/weather',
            responseType: 'json',
            params: {
              destination: this.selected //!!
            }
          }
        ).then(function (response) {
          console.log('weatherレスポンス');
          console.log(response.data.data);
          console.log(response.data.icon);

          me.weather = '<div class="col">'
            + '<p>今のお天気：' + response.data.data + '</p>'
            + '<p><img src="https://openweathermap.org/img/wn/' + response.data.icon + '@2x.png"></p>'
            + '</div>';

        }).catch(function (response) {
          console.log(response);
          console.log('inキャッチ');
          me.weather = 'エラーが発生しました';
        });
      },

      getTweets: function (v) {
        const me = this //!!!!!

        axios(
          {
            method: 'GET',
            url: '/api/tweets',
            responseType: 'json',
            params: {
              destination: this.selected //!!
            }
          }
        ).then(function (response) {
          // console.log('tweitterレスポンス');
          // console.log(response.data.food);
          // console.log(response.data.weather);

          const makeTweetHtml = function (value, index) {
            console.log('makehtml関数内');
            console.log(value);
            targetDom.push('<a href="https://twitter.com/' + value.user.screen_name + '/status/' + value.id_str + '" class="test-dark" target="_blank"><p>画像：<img src="' + value.mediaUrl + '" class="img-fluid"></p><p>ツイート内容：' + value.full_text + '</p></a>');
          };

          //天気
          me.twitterWeathers = []; //配列にするのが重要！pushのため

          var targetDom = me.twitterWeathers;

          response.data.weather.forEach(makeTweetHtml);


          //食べ物
          me.twitterFoods = []; //配列にするのが重要！pushのため

          var targetDom = me.twitterFoods;

          response.data.food.forEach(makeTweetHtml);

        }).catch(function (response) {
          console.log(response);
          console.log('inキャッチ');

          me.twitterWeathers = 'エラーが発生しました';

          //食べ物
          me.twitterFoods = 'エラーが発生しました';
        });
      },
    }
  }
);

