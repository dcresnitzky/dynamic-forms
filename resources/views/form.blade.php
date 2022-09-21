@extends('template')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Form Builder Demo</h1>
        </div>

        <div class="col-md-6 text-right">
            <!-- This form holds the values the user has entered, as a JSON document. -->
            <form method="post" action="{{ route('validate') }}" id="submissionForm">
                @csrf
                <input type="hidden" name="definition" value='{!! $definition !!}'>

                <!-- State can be used to capture a Submit vs. Save Draft button -->
                <input type="hidden" name="state">

                <!-- The JSON with all the values -->
                <input type="hidden" name="submissionValues" id="submissionValues" value="">
            </form>
        </div>
    </div>

    <!-- Any server-side errors will be shown here. This is a fallback for when the client-side validations miss something. -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <p style="font-size: 16pt"><strong>Oops</strong>, there was an issue with that.</p>
            <ul class="ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- This becomes the builder. -->
    <div id="formio-form"></div>
@endsection

@push('footer.scripts')
    <script lang="text/javascript">
        window.onload = function () {
            Formio.createForm(
                document.getElementById('formio-form'),
                {!! $definition !!}
            ).then(function (form) {

                form.submission = {
                    data: @json($data),
                    form: {!! $definition !!}
                };

                form.on('submit', function (submission) {
                    let submitForm = document.getElementById('submissionForm');
                    submitForm.querySelector('input[name=state]').value = submission.state;
                    submitForm.querySelector('input[name=submissionValues]').value = JSON.stringify(submission.data);

                    submitForm.submit();
                });
            });
        };
    </script>
@endpush
