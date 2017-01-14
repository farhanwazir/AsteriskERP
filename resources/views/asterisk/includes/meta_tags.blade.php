@section('meta_tags')
<meta name="title" content="ERP Solution">
<meta name="description" content="This is temprary description of this file for Search Engines.">

@if(Auth::check())
{{-- Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
@endif

{{-- Social Media Meta's --}}
<meta content="summary" name="twitter:card">
<meta content="cideator.com" name="twitter:domain">

<meta content="OM" name="twitter:app:country">

<meta content="Creative Ideator iOS" name="twitter:app:name:iphone">
<meta content="789998877" name="twitter:app:id:iphone">
<meta content="se-zaphod://cideator.com" name="twitter:app:url:iphone">

<meta content="Creative Ideator iOS" name="twitter:app:name:ipad">
<meta content="789998877" name="twitter:app:id:ipad">
<meta content="se-zaphod://cideator.com" name="twitter:app:url:ipad">

<meta content="Creative Ideator Android" name="twitter:app:name:googleplay">
<meta content="http://cideator.com" name="twitter:app:url:googleplay">
<meta content="com.erpsolution.cideator" name="twitter:app:id:googleplay">

<meta content="website" property="og:type">
<meta content="http://cideator.com/logo.png" itemprop="image primaryImageOfPage" property="og:image">
<meta content="ERP Solution" itemprop="title name" property="og:title" name="twitter:title">
<meta content="This is temprary description of this file for social media." itemprop="description" property="og:description" name="twitter:description">
<meta content="http://cideator.com" property="og:url">
@endsection