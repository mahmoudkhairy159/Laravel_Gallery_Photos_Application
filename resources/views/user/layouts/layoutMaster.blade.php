@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'user.layouts.horizontalLayout' :
(( $configData["layout"] === 'blank') ? 'user.layouts.blankLayout' : 'user.layouts.contentNavbarLayout') ))
@endisset

@include('user.layouts.alert')
