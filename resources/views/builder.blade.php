@extends('template')

@section('content')
    <div class="row">
        <h1>Form Builder Demo</h1>

        <div id="formio-builder"></div>

        <!-- This becomes the builder. -->
        <!-- This form holds the JSON form definition. -->
        <form method="post" action="{{ route('store') }}" class="container-fluid">
            @csrf
            <!-- Form definition -->
            <input type="hidden" name="definition" id="definition" value="">

            <button type="submit" class="btn btn-outline-primary">
                <i class="fa fa-save" aria-hidden="true"></i>
                Save Form
            </button>
        </form>
    </div>
@endsection

@push('footer.scripts')
    <!-- The options can be customized to control the available elements. -->
    <script lang="text/javascript">
        window.onload = function () {
            new Formio.builder(
                document.getElementById('formio-builder'),
                {},
                {} // these are the opts you can customize
            ).then(function (builder) {
                // Exports the JSON representation of the dynamic form to that form we defined above
                document.getElementById('definition').value = JSON.stringify(builder.schema);

                builder.on('change', function (e) {
                    // On change, update the above form w/ the latest dynamic form JSON
                    document.getElementById('definition').value = JSON.stringify(builder.schema);
                })
            });
        };
    </script>
@endpush
