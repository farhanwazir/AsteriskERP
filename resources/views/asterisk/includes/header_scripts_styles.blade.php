{{-- Remove comment on production

    <script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/public{ elixir('js/app.js') }}"></script>
    <link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/public{ elixir('css/all.css') }}" />
    <link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/public{ elixir('css/app.css') }}" />
    <link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/public{ elixir('css/app.css') }}" />
    --}}
<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/bootstrap/dist/js/bootstrap.js"></script>
<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/bootstrap/dist/css/bootstrap.css" />
{{-- link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/bootstrap/dist/css/bootstrap-theme.css" > --}}
<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/admin-lte/dist/css/AdminLTE.css" />
<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/admin-lte/dist/css/skins/_all-skins.css" />

<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/bootstrap-form-helpers/dist/js/bootstrap-formhelpers.js"></script>
<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/bootstrap-form-helpers/dist/css/bootstrap-formhelpers.css" />

<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/admin-lte/dist/js/app.js"></script>

{{-- adminlte plugins --}}
<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/admin-lte/plugins/slimScroll/jquery.slimScroll.js"></script>
{{-- end load adminlte plugins --}}

<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/custom-js/typeahead/typeahead.bundle.js"></script>
<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/custom-js/handlebars.js"></script>
<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/custom-js/general.js"></script>
<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/jquery-datetextentry/jquery.datetextentry.js"></script>

<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/jquery-datetextentry/jquery.datetextentry.css" />
<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/MagicalFont/src/magicalfont.css" />
<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/custom-css/style.css" />

<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/jasny-bootstrap/dist/js/jasny-bootstrap.js"></script>
<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/jasny-bootstrap/dist/css/jasny-bootstrap.css" />

<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/Chart.js/Chart.min.js"></script>
<script type="text/javascript" src="http://127.0.0.1:8080/AsteriskERP/resources/assets/jVectorMap/jquery-jvectormap-2.0.3.min.js"></script>
<link rel="stylesheet" href="http://127.0.0.1:8080/AsteriskERP/resources/assets/jVectorMap/jquery-jvectormap-2.0.3.css" />

@if(Auth::check())
    <!-- Ajax request setup -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endif

<!-- Respond.js for IE8 support of media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!---------------- END ---------------------->