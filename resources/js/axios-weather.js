console.log('weather用 axions ココカラ');

new Vue(
  {
    el: '#main',
    data: {
      parameters: []
    },
    mounted: function () {
      var v = this;
      v.catlist(v);
    },
    methods: {
      catlist: function (v) {
        axios(
          {
            method: 'GET',
            url: '/get-axios',
            responseType: 'json'
          }
        ).then(function (responce) {
          // responce.data;
          v.parameters = responce.data.categories;
          console.log(v.parameters);
        }).catch(function (responce) {
          console.log(responce);
        });
      }
    }
  }
);