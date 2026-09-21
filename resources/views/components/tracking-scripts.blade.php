@inject('trackingService', 'App\Services\TrackingService')

@if(isset($position) && $position === 'body_start')
    {!! $trackingService->renderBodyStartScripts() !!}
@elseif(isset($position) && $position === 'body_end')
    {!! $trackingService->renderBodyEndScripts() !!}
@else
    {!! $trackingService->renderHeadScripts() !!}
@endif
