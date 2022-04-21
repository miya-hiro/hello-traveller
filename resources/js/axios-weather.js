console.log('weather用 JS ココカラ');

Vue.component('weather-now', {
  props: ['item'],
  template: `
  <div v-if="item" class="mt-5 text-center">
  <h3 class="mb-2"><span><slot/></span></h3>
    <div class="weather-card">
      <div class="col"><p>今のお天気：{{item.data}}</p>
        <p><img :src="'https://openweathermap.org/img/wn/' + item.icon + '@2x.png'"></p>
      </div>
    </div>
  </div>
`
})

Vue.component('tweet-list', {
  props: ['items'],
  template: `
  <div v-if="items.length" class="mt-5 text-center">
    <h3 class="mb-3"><span><slot/></span></h3>
    <div class="card-wrappder">
      <ul class="row list-unstyled">
        <li v-for="(item, index) in items" :key="item" class="col-sm-6 col-md-4 col-lg-3">
        <a :href="'https://twitter.com/' + item.user.screen_name + '/status/' + item.id_str" class="test-dark" target="_blank">
        <p><img :src="item.mediaUrl" class="img-fluid"></p>
        <p>{{item.full_text}}</p>
        </a>
      </li>
      </ul>
    </div> <!-- /.card-wrappder -->
  </div>
`
})

/**
 * for Vue
 */
new Vue(
  {
    el: '#axios-practice',
    data: function () {
      return {
        twitterWeathers: [],
        twitterFoods: [],
        selected: '', //初期に選ばれているoption。v-model="selected" と連動
        weather: '',
        options: [
          { text: 'Open this select menu', value: '' },
          { text: 'SAPPORO', value: '札幌' },
          { text: 'AKITA', value: '秋田' },
          { text: 'IWATE', value: '岩手' },
          { text: 'NAGANO', value: '長野' },
          { text: 'TOKYO', value: '東京' },
          { text: 'TIBA', value: '千葉' },
          { text: 'KANAGAWA', value: '神奈川' },
          { text: 'TOCHIGI', value: '栃木' },
          { text: 'GIFU', value: '岐阜' },
          { text: 'ISHIKAWA', value: '石川' },
          { text: 'OSAKA', value: '大阪' },
          { text: 'HYOGO', value: '兵庫' },
          { text: 'NARA', value: '奈良' },
          { text: 'KYOTO', value: '京都' },
          { text: 'HIROSHIMA', value: '広島' },
          { text: 'OKAYAMA', value: '岡山' },
          { text: 'TOKUSHIMA', value: '徳島' },
          { text: 'FUKUOKA', value: '福岡' },
          { text: 'SAGA', value: '佐賀' },
          { text: 'OKINAWA', value: '沖縄' }
        ]
      }
    },
    methods: {
      getData: function () { //!!
        this.getWeather();
        this.getTweets();
      },
      getWeather: function (v) {
        const me = this //!!!!!

        // const parentDiv = document.getElementById("js-weather");

        // if (parentDiv.classList.contains("effect-on")) {
        //   parentDiv.classList.remove("effect-on")
        // }

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
          console.log(response.data.icon);

          me.weather = response.data;
          // me.weather = '<div class="col">'
          //   + '<p>今のお天気：' + response.data.data + '</p>'
          //   + '<p><img src="https://openweathermap.org/img/wn/' + response.data.icon + '@2x.png"></p>'
          //   + '</div>';

        }).catch(function (response) {
          // console.log(response);
          // console.log('inキャッチ');

          me.weather = 'エラーが発生しました';
        }).finally(function () {

          // parentDiv.classList.add("effect-on")
        });

      },

      getTweets: function (v) {
        const me = this //!!!!!

        // const twitterWeatherWrapper = document.getElementById("js-twitterWeatherWrap");
        // const twitterFoodWrapper = document.getElementById("js-twitterFoodWrap");

        // リセット
        // if (twitterWeatherWrapper.classList.contains("effect-on")) {
        //   twitterWeatherWrapper.classList.remove("effect-on")
        // }
        // me.twitterWeathers = [];

        // if (twitterFoodWrapper.classList.contains("effect-on")) {
        //   twitterFoodWrapper.classList.remove("effect-on")
        // }
        // me.twitterFoods = [];


        axios(
          {
            method: 'GET',
            url: '/api/tweets',
            responseType: 'json',
            params: {
              destination: this.selected //!!
            }
          }
        ).then(function (response) { //200の場合
          console.log('tweitterレスポンス');
          console.log(me.twitterWeathers);


          // if (!twitterWeatherWrapper.classList.contains("effect-on")) {
          //   twitterWeatherWrapper.classList.add("effect-on")
          // }
          // if (!twitterFoodWrapper.classList.contains("effect-on")) {
          //   twitterFoodWrapper.classList.add("effect-on")
          // }

          // const makeTweetHtml = function (value, index) {

          //   //
          //   let regexp = /https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+/g;
          //   full_text = value.full_text.replace(regexp, '');

          //   targetProperty.push('<a href="https://twitter.com/' + value.user.screen_name + '/status/' + value.id_str + '" class="test-dark" target="_blank"><p><img src="' + value.mediaUrl + '" class="img-fluid"></p><p>' + full_text + '</p></a>');
          // };

          // //天気
          // var targetProperty = me.twitterWeathers;

          // response.data.weather.forEach(makeTweetHtml);


          me.twitterWeathers = response.data.weather;

          //食べ物
          me.twitterFoods = response.data.food;

          // var targetProperty = me.twitterFoods;

          // response.data.food.forEach(makeTweetHtml);

        }).catch(function (response) { //500とか
          console.log(response);
          console.log('inキャッチ');

          me.twitterWeathers = 'エラーが発生しました';

          //食べ物
          me.twitterFoods = 'エラーが発生しました';
        }).finally(function () {
          // parentDiv.classList.add("effect-on")
        });
      },
    }
  }
);

