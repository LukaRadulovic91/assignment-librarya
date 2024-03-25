@extends('layout')

@section('data-tables-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')

@include('pages.partials.system_messages')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Articles</h1>

    <div class="row">

        <div class="card widget-flat col-lg-5 mr-5">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-pulse widget-icon"></i>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Growth">Reviewed Articles</h5>
                <h3 class="mt-3 mb-3">{{ $reviewedArticles }}</h3>
                <p class="mb-0 text-muted">

            </div>
        </div>

        <div class="card widget-flat col-lg-5">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-pulse widget-icon"></i>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Growth">Unreviewed Articles</h5>
                <h3 class="mt-3 mb-3">{{ $unreviewedArticles }}</h3>
                <p class="mb-0 text-muted">

            </div>
        </div>
    </div>


</div>
@endsection
