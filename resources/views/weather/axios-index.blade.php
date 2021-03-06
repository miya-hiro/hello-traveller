@extends('layouts.app')

@section('title', ' お天気サーチ')


@section('content')

@php

@endphp

<div class="container">

  <div class="row">
    <div class="col-12">
      <div class="card mt-3">
        <div class="card-body pt-0">
          <div class="card-text">

            <select name="destination" class="form-select form-select-lg mb-3" aria-label=".form-select-lg select example">
              <option selected>Open this select menu</option>
              <option value="札幌">SAPPORO</option>
              <option value="東京">TOKYO</option>
              <option value="大阪">OSAKA</option>
              <option value="沖縄">OKINAWA</option>
            </select>

            <!-- ここからAjax -->
            <div id="show-axios" class="container-fluid">
              <h1>axios使用</h1>
              <h2>今の天気</h2>
              <div id="js_weatherWrap" class="row">
                <div class="col">
                  Column
                </div>
                <div class="col">
                  Column
                </div>
              </div>
              <h2>天気関連ツイート</h2>
              <div id="js_tweetWeatherWrap" class="row">
                <div class="col">
                  Column
                </div>
                <div class="col">
                  Column
                </div>
                <div class="col">
                  Column
                </div>
              </div>
              <h2>食べ物関連ツイート</h2>
              <div id="js_tweetFoodWrap" class="row">
                <div class="col">
                  Column
                </div>
                <div class="col">
                  Column
                </div>
                <div class="col">
                  Column
                </div>
              </div>
            </div>
          </div>
          <!-- ここまでAjax -->

        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection