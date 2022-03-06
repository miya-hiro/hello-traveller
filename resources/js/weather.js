console.log('weather用jsココカラ');

$('[name = "destination"]').on('change', function () {
  var destination = $(this).val();
  console.log('changeイベント');
  console.log(destination);

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
    .done(function (result) {
      console.log("success");
      console.log(result);
    })

    .fail(function () {
      console.log("failed");
    })
});
