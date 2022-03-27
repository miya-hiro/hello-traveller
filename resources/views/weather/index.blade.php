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
                <h2>Where do you want to go??</h2>
                <select v-model="selected" name="destination" @change="getData" class="custom-select sources" placeholder="select">
                  <option v-for="op in options" v-bind:value=op.value :key="op">@{{op.text}}</option>
                </select>
              </div>

              <div class="container-fluid">

                <div id="js-weather" class="effect-fade mt-5 text-center">
                  <h3>Current weather</h3>
                  <div class="card-wrappder">
                    <div v-html="weather" class="row">
                    </div>
                  </div> <!-- /.card-wrappder -->
                </div>

                <div id="js-twitterWeatherWrap" class="effect-fade mt-5 text-center">
                  <h3>Tweets about weather</h3>
                  <div class="card-wrappder">
                    <ul class="row list-unstyled">
                      <li v-html="twitterWeather" 
                      v-for="twitterWeather of twitterWeathers" 
                      :key="twitterFood" 
                      class="col">
                      </li>
                    </ul>
                  </div> <!-- /.card-wrappder -->
                </div>

                <div id="js-twitterFoodWrap" class="effect-fade mt-5 text-center">
                  <h3>Tweets about "Oishi"</h3>
                  <div class="card-wrappder">
                    <ul class="row list-unstyled">
                      <li v-html="twitterFood" v-for="twitterFood of twitterFoods" :key="twitterFood" class="col">
                      </li>
                    </ul>
                  </div>  <!-- /.card-wrappder -->
                </div>

              </div> <!-- /.container-fluid -->
            </div> <!-- ここまでAxios -->


          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection