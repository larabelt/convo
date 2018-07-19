@isset($alerts)
    @each('belt-notify::layouts.shared.partials._alert', $alerts, 'alert')
@endif