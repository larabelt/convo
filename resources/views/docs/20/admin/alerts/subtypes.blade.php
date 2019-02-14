<a name="alerts-subtypes"></a>

The alert can be customized in the following three ways:

* For an alert that has a X to dismiss, leave Dismiss Button blank.

@include('belt-core::docs.partials.image', ['src' => '20/admin/notify/assets/param-dismiss-button.png'])

* For an alert that has a button to dismiss, fill in the Dismiss Button section.
* An alert that has a button that links to a page. That page can open in the same or new window.
* For a button that links out, fill in Alert URL Extras section and Show URL section.

@include('belt-core::docs.partials.image', ['src' => '20/admin/notify/assets/param-alert-extras.png'])

If the url being used is to a third party site (a site outside of the Dominica site) the url requires http:// or https:// to work.

To include a url from the Dominica site, fill in the URL field with the last, relative part of the url. Ex. /experiences to link to the Experiences page.

@include('belt-core::docs.partials.image', ['src' => '20/admin/notify/assets/alert-editor-show-url.png'])
