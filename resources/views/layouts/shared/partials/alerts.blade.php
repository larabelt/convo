@isset($alerts)
    @each('belt-convo::layouts.shared.partials._alert', $alerts, 'alert')
@endif