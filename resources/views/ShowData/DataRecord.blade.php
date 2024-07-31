<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแสดงตรวจสอบข้อมูล</title>
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/fonts/vendor/boxicons') }}">
    <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/boxicons.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('public/images/pcbboard.png') }}" type="image/x-icon">
</head>

<body>

    <div class="container mt-2">
        <h4 class="mt-3 text-center" id="textheader2">ตรวจสอบข้อมูลที่บันทึก linecall</h4>
        <div style="background: #fff;" class="p-3 mt-3">
            <p class="mt-1 text-center" id="textheader3">ข้อมูลหลัก Line Call</p>
            @foreach ($documents as $document)
                <div class="row">
                    <div class="col-sm-4">
                        <p style="color: #0f4c5c; font-size: 20px; font-weight: bold;">เลขที่เอกสาร:
                            <span>{{ $document->LNCL_HREC_REFDOC }}</span>
                        </p>
                        <!-- Display other document fields -->
                    </div>
                    <div class="col-sm-4">
                        <p style="color: #0f4c5c; font-size: 20px; font-weight: bold;">แผนก:
                            <span>{{ $document->LNCL_HREC_SECTION }}</span>
                        </p>
                        <!-- Display other document fields -->
                    </div>
                    <div class="col-sm-4">
                        <p style="color: #0f4c5c; font-size: 20px; font-weight: bold;">รหัสพนักงาน:
                            <span>{{ $document->LNCL_HREC_EMPID }}</span>
                        </p>
                        <!-- Display other document fields -->
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="background: #0f4c5c; color: #fff;">Line</th>
                            <th style="background: #0f4c5c; color: #fff;">Customer</th>
                            <th style="background: #0f4c5c; color: #fff;">Work Order</th>
                            <th style="background: #0f4c5c; color: #fff;">Model Code</th>
                            <th style="background: #0f4c5c; color: #fff;">Model Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_LINE }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_CUS }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_WON }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_MDLCD }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_MDLNM }}</td>
                        </tr>
                    </tbody>


                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="background: #1b263b; color: #fff;">NG Code</th>
                            <th style="background: #1b263b; color: #fff;">NG Process</th>
                            <th style="background: #1b263b; color: #fff;">Qty</th>
                            <th style="background: #1b263b; color: #fff;">Defict</th>
                            <th style="background: #1b263b; color: #fff;">Percent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_NGCD }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_NGPRCS }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_QTY }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_DEFICT }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;">
                                {{ $document->LNCL_HREC_PERCENT }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="background: #184e77; color: #fff;" colspan="3">NG Position</th>
                            <th style="background: #184e77; color: #fff;" colspan="2">Serial Number</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;"
                                colspan="3">
                                {{ $document->LNCL_HREC_NGPST }}</td>
                            <td style="color: #001233; font-size: 20px; font-weight: bold; background: #fbf8cc;"
                                colspan="2">
                                {{ $document->LNCL_HREC_SERIAL }}</td>

                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <p style="background: #0d3b66; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                            Problem</p>
                        <textarea rows="11" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $document->LNCL_HREC_PROBLEM }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <p style="background: #0d3b66; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                            Images (Problem)</p>

                        @foreach ($images as $group)
                            @foreach ($group as $image)
                                <div>
                                    <img src="{{ asset('public/images/' . $image->LNCL_IMAGES_FILES) }}"class="mt-1"
                                        width="300px" onclick="ViewImage('{{ $image->LNCL_IMAGES_FILES }}')"><br>
                                    <!-- Display other image fields -->
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p style="background: #0d3b66; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                            Cause</p>
                        <textarea rows="11" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $document->LNCL_HREC_CAUSE }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <p style="background: #0d3b66; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                            Temporary Action</p>
                        <textarea rows="11" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $document->LNCL_HREC_ACTION }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>


    </div>

    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables.min.js') }}"></script>
    <script src="{{ asset('public/js/all.min.js') }}"></script>
</body>

</html>
