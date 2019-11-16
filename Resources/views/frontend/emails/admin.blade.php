@extends('idownload::frontend.emails.mainlayout')
@php
    $form=$lead['form'];
    $data=$lead['lead'];
@endphp


@section('content')
  <div id="contend-mail" class="p-3">
    <h1>{{ $form->title }}</h1>
    <br>
    <div>
        {{ trans('idownload::idownloads.notification.admin') }}
    </div>
    <div style="margin-bottom: 5px">
      @foreach($data as $index => $field)
        <p class="px-3"><strong>{{ trans('idownload::suscriptors.mail.'.$index) }}:</strong> {!! $field !!} </p>
      @endforeach
    </div>
  </div>
@stop
