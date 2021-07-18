<?php
/**
 * Template Name: policy
 */
?>

@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="policy-page">
    <div class="container">
      {{the_content()}}
    </div>
  </div>
@endsection
