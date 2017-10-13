<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id={{config('constants.GOOGLE_ANALYTICS_KEY')}}"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', '{{config('constants.GOOGLE_ANALYTICS_KEY')}}');
</script>

<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="Scotch">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nanaimo Open Chess Tournament</title>

<!-- load bootstrap from a cdn -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/css/main.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous">

<link rel="shortcut icon" href="{{{ asset('/images/favicon.ico') }}}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey={{config('constants.TINY_MCE_KEY')}}"></script>
<script>tinymce.init({
        selector: 'textarea',
        plugins: "hr code anchor autoresize table image",
    });
</script>
<script type="text/javascript" src="{{ URL::asset('/js/main.js') }}"></script>
<link rel="stylesheet" href="css/blueimp-gallery.min.css">
