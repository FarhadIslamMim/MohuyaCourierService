@extends('backend.layouts.master')
@section('title', 'Summary Report')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')

    <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null" {{-- href="https://unpkg.com/milligram@1.3.0/dist/milligram.min.css"> --}}
    @endsection
    @section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Summary Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Percel Manage</a></li>
                        <li class="breadcrumb-item active">Summary Report</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Summary Report content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <main class="wrapper" style="padding-top:2em">

                    <section class="container" id="demo-content">
                        <h1 class="title">Scanning</h1>
                            <a class="btn btn-primary" id="startButton">Start</a>
                            <a class="btn btn-primary" id="resetButton">Reset</a>
                        </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
                            </div>

                            <div id="sourceSelectPanel" style="display:none">
                                <label for="sourceSelect">Change video source:</label>
                                <select id="sourceSelect" style="max-width:400px">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Result:</label>
                            <pre><code id="result"></code></pre>
                        </div>
                    </div>

                    </section>


                </main>
            </div>
        </div>
    </div>
    <!-- Summary Report content end -->

@endsection
    @section('custom-scripts') <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest/umd/index.min.js"></script>



    <script type="text/javascript">
        window.addEventListener('load', function() {
            let selectedDeviceId;
            const codeReader = new ZXing.BrowserMultiFormatReader()
            console.log('ZXing code reader initialized')
            codeReader.listVideoInputDevices()
                .then((videoInputDevices) => {
                    const sourceSelect = document.getElementById('sourceSelect')
                    selectedDeviceId = videoInputDevices[0].deviceId
                    if (videoInputDevices.length >= 1) {
                        videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option')
                            sourceOption.text = element.label
                            sourceOption.value = element.deviceId
                            sourceSelect.appendChild(sourceOption)
                        })

                        sourceSelect.onchange = () => {
                            selectedDeviceId = sourceSelect.value;
                        };

                        const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                        sourceSelectPanel.style.display = 'block'
                    }

                    document.getElementById('startButton').addEventListener('click', () => {
                        codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                            if (result) {
                                console.log('found ' + result)
                                var text = document.createElement('p');
                                text.innerHTML = result.text;
                                // for (let index = 0; index < barcode_result.length; index++) {

                                // }
                                document.getElementById('result').appendChild(text)

                            }
                            if (err && !(err instanceof ZXing.NotFoundException)) {
                                console.error(err)
                                document.getElementById('result').textContent = err
                            }
                        })
                        console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
                    })

                    document.getElementById('resetButton').addEventListener('click', () => {
                        codeReader.reset()
                        document.getElementById('result').textContent = '';
                        console.log('Reset.')
                    })

                })
                .catch((err) => {
                    console.error(err)
                })
        })
    </script>
@endsection
