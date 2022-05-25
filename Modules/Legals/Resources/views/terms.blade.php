@extends('master.main')

@section('title','Terms and Conditions')

@section('content')
    @include('includes.breadcrumb',[
        'breadcrumb' => [
            'Home'         => '/',
            'Terms'        => route('legals.terms'),
        ]
    ])
<div class="row">
    <div class="col-md-12">
        <h1>Terms and Conditions</h1>

        <h5>We <strong>DO NOT</strong> allow below in any kind:</h5>
        <ol>
            <li>We <strong>DO NOT</strong> allow child porn.</li>
            <li>We <strong>DO NOT</strong> allow Animal abuse.</li>
            <li>We <strong>DO NOT</strong> allow Snuff movies.</li>
            <li>We <strong>DO NOT</strong> allow Weapons.</li>
        </ol>

        <h5>Personal data:</h5>
        <ol>
            <li>We DO NOT gather or share any of your data with others.</li>
            <li>NEVER share your recovery mnemonic with others.</li>
            <li>NEVER share your account or password with others.</li>
        </ol>

        <h5>Recovering account:</h5>
        <p>
            You can recover your account with your personal mnemonic that you got when signing up the first time OR with your PGP key. If you don't have one of those above your are not able to recover your account.
        </p>

        <h5>Escrow & Funds:</h5>
        <p>This is a walletless market which means there is no wallet on the market and all bitcoins go directly to the escrow system. There are no bitcoin deposits.</p>

        <h5>FE Finalize Early.</h5>
        <p>We DO NOT have FE and we don't have too, this is to minimize scams on product transactions by vendors.</p>
    </div>
</div>
@stop
