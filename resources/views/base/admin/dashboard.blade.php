@extends('belt-core::layouts.admin.main')

@section('heading-title', '')
@section('heading-subtitle', '')
@section('heading-active', '')

@section('main')

    <div id="belt-convo">
        <router-view></router-view>
    </div>

@stop