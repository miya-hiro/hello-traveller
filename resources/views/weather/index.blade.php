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
                    <option v-for="op in options" v-bind:value=op.value :key="op.text">@{{op.text}}</option>
                  </select>
                </div>
              </div>

              <div class="container-fluid">

                <!-- ここから天気 -->
                <weather-now :item="weather">Current weather</weather-now>

                <!-- ここからtwitter -->
                <tweet-list :items="twitterWeathers">Tweets about "weather"</tweet-list>

                <tweet-list v-bind:items="twitterFoods">Tweets about "Oishi"</tweet-list>

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