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

            <!-- ここからAxios -->
            <div id="axios-practice" class="card-text">

              <div class="text-center">
                <h2 class="bounce">Where do you want to go??</h2>
                <div class="select-a">
                  <select v-model="selected" name="destination" @change="getData" placeholder="select" v-cloak>
                    <option v-for="op in options" v-bind:value=op.value :key="op">@{{op.text}}</option>
                  </select>
                </div>
              </div>

              <div class="container-fluid">

                <!-- コンポーネント化。渡すデータだけ変えれば良いようにする -->
                <tweet-list :items="twitterWeathers">Tweets about "weather"</tweet-list>
                <tweet-list :items="twitterFoods">Tweets about "Oishi"</tweet-list>

                <!-- <div id="js-weather" class="effect-fade mt-5 text-center">
                  <h3 class="mb-2"><span>Current weather</span></h3>
                  <div class="weather-card">
                    <div v-html="weather" class="row">
                    </div>
                  </div> 
                </div>

                <div id="js-twitterFoodWrap" class="effect-fade mt-5 text-center">
                  <h3 class="mb-3"><span>Tweets about "Oishi"</span></h3>
                  <div class="card-wrappder">
                    <ul class="row list-unstyled">
                      <li v-html="twitterFood" v-for="twitterFood of twitterFoods" :key="twitterFood" class="col-sm-6 col-md-4 col-lg-3">
                      </li>
                    </ul>
                  </div>
                </div> -->

              </div> <!-- /.container-fluid -->
            </div> <!-- ここまでAxios -->

          </div>
        </div>
      </div>
    </div>
  </div>

  <transition>
    <div id="btn" class="Page-Btn" v-if="scroll" @click="scrollTop">
      TOP
    </div>
  </transition>
</div>
@endsection