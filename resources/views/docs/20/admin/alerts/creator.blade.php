<a name="alerts-creator"></a>

## How to Create an Alert

To add an Alert to the site, go to Alerts → Add Alerts

@include('belt-core::docs.partials.table', [
    'rows' => [
        ['Is Active', 'Check to make the Alert page publicly available.'],
        ['Name', 'Name of Alert'],
        ['Starts at', 'Indicate date and time you want Alert to start'],
        ['Ends at', 'Indicate date and time you want Alert to end'],
        ['Intro', 'Leave blank'],
        ['Body', 'Body appears in alert on front end'],
    ],
])

@include('belt-core::docs.partials.image', ['src' => '20/admin/notify/assets/alert-example.png'])

Click on "Save." Three Additional sections will appear.