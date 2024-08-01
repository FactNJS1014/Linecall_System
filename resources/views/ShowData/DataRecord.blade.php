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
        <div style="background: #EEEEEE;" class="p-3 mt-3 mb-3">
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
                            <th style="background: #0D8549; color: #fff;">Line</th>
                            <th style="background: #0D8549; color: #fff;">Customer</th>
                            <th style="background: #0D8549; color: #fff;">Work Order</th>
                            <th style="background: #0D8549; color: #fff;">Model Code</th>
                            <th style="background: #0D8549; color: #fff;">Model Name</th>
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
                            <th style="background: #0D8549; color: #fff;">NG Code</th>
                            <th style="background: #0D8549; color: #fff;">NG Process</th>
                            <th style="background: #0D8549; color: #fff;">Qty</th>
                            <th style="background: #0D8549; color: #fff;">Defict</th>
                            <th style="background: #0D8549; color: #fff;">Percent</th>
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
                            <th style="background: #0D8549; color: #fff;" colspan="3">NG Position</th>
                            <th style="background: #0D8549; color: #fff;" colspan="2">Serial Number</th>


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
                        <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                            Problem</p>
                        <textarea rows="11" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $document->LNCL_HREC_PROBLEM }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
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
                        <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                            Cause</p>
                        <textarea rows="11" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $document->LNCL_HREC_CAUSE }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                            Temporary Action</p>
                        <textarea rows="11" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $document->LNCL_HREC_ACTION }}</textarea>
                    </div>
                </div>
            @endforeach

            <p class="mt-3 text-center" id="textheader3">ข้อมูลปัญหา 5 Why ของ Leak Problem</p>
            @foreach ($leakdoc as $leak)
                <div class="row">
                    <div class="col-md-4">
                        <p id="text1">รหัสพนักงาน: <span>{{ $leak->LNCL_LEAKANDROOT_EMPID }}</span></p>
                    </div>
                    <div class="col-md-4">
                        <p id="text1">ชื่อผู้บันทึก: <span>{{ $leak->LNCL_LEAKANDROOT_NAME }}</span></p>
                    </div>
                    <div class="col-md-4">
                        <p id="text1">แผนก: <span>{{ $leak->LNCL_LEAKANDROOT_SECTION }}</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;"
                            class="p-2">
                            5 Why of leak</p>
                        <textarea rows="3" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_LEAK_WHY1 }}</textarea>
                        <textarea rows="3" class="form-control mt-2" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_LEAK_WHY2 }}</textarea>
                        <textarea rows="3" class="form-control mt-2" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_LEAK_WHY3 }}</textarea>
                        <textarea rows="3" class="form-control mt-2" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_LEAK_WHY4 }}</textarea>
                        <textarea rows="3" class="form-control mt-2" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_LEAK_WHY5 }}</textarea>

                    </div>
                    <div class="col-md-6">
                        <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;"
                            class="p-2">
                            Images 5 Why of leak</p>
                        @foreach ($imagesleak as $group)
                            @foreach ($group as $imgl)
                                <div>
                                    <img src="{{ asset('public/images/' . $imgl->LNCL_IMAGES_FILES) }}"class="mt-1"
                                        width="300px" onclick="ViewImage('{{ $imgl->LNCL_IMAGES_FILES }}')"><br>
                                    <!-- Display other image fields -->
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="row p-2">
                    <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                        leak Action from 5 Why</p>
                    <textarea rows="3" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_LEAK_ACTION }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;"
                            class="p-2">
                            5 Why of Root</p>
                        <textarea rows="3" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_ESC_WHY1 }}</textarea>
                        <textarea rows="3" class="form-control mt-2" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_ESC_WHY2 }}</textarea>
                        <textarea rows="3" class="form-control mt-2" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_ESC_WHY3 }}</textarea>
                        <textarea rows="3" class="form-control mt-2" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_ESC_WHY4 }}</textarea>
                        <textarea rows="3" class="form-control mt-2" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_ESC_WHY5 }}</textarea>

                    </div>
                    <div class="col-md-6">
                        <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;"
                            class="p-2">
                            Images 5 Why of leak</p>
                        @foreach ($imagesroot as $group)
                            @foreach ($group as $imgr)
                                <div>
                                    <img src="{{ asset('public/images/' . $imgr->LNCL_IMAGES_FILES) }}"class="mt-1"
                                        width="300px" onclick="ViewImage('{{ $imgr->LNCL_IMAGES_FILES }}')"><br>
                                    <!-- Display other image fields -->
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="row p-2">
                    <p style="background: #0D8549; color: #fff; font-size: 20px; font-weight: bold;" class="p-2">
                        Root Action from 5 Why</p>
                    <textarea rows="3" class="form-control" style="color: #001233; font-size: 20px; font-weight: bold;">{{ $leak->LNCL_ESC_ACTION }}</textarea>
                </div>
            @endforeach

            <div class="d-flex justify-content-center mt-3">
                <button type="button" class="btn btnapprove">ยืนยันการส่งอนุมัติ</button>
                <button type="button" class="btn btnedit"
                    onclick="gotoEdit('{{ $recid }}')">แก้ไขข้อมูลการบันทึก</button>
                <button type="button" class="btn btndelete">ลบข้อมูลการบันทึก</button>
            </div>
        </div>


    </div>

    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables.min.js') }}"></script>
    <script src="{{ asset('public/js/all.min.js') }}"></script>
    <script>
        function ViewImage(images) {

            //Createoverlay
            var overlay = document.createElement('div');
            overlay.className = 'overlay';
            overlay.onclick = function() {
                document.body.removeChild(overlay);
                document.body.removeChild(zoomedImage);
            };
            //Createzoomedimage
            var zoomedImage = document.createElement('img');
            zoomedImage.src = "{{ asset('public/images/') }}" + "/" + images;
            zoomedImage.className = 'zoomed';
            //Appendtobody
            document.body.appendChild(overlay);
            document.body.appendChild(zoomedImage);

        }

        /**
         * TODO:31-07-2024
         * *ส่งค่า recid ไปยังหน้าที่จะแก้ไขข้อมูล
         * **/

        function gotoEdit(id) {
            //alert(id)
            let html = '';
            html +=
                '<button class="btn btngo" onclick=\'gotoPageForm1("' + id +
                '")\'> Go to แก้ไขฟอร์ม 1 (ข้อมูลหลัก)</button>'
            html += '<button class="btn btngo mt-3" onclick=\'gotoPageForm2("' + id +
                '")\'> Go to แก้ไขฟอร์ม 2 (5 Why)</button>'

            Swal.fire({
                title: 'เลือกหน้าที่ต้องการแก้ไข',
                html: html,
                showCancelButton: true,
                showConfirmButton: false,

            })
        }

        function gotoPageForm1(recid) {
            axios.get('{{ route('index') }}?recid=' + recid)
                .then(response => {
                    // Handle the response
                    window.location.href = response.request.responseURL;
                })
                .catch(error => {
                    // Handle the error
                    console.error('There was an error!', error);
                });

        }

        function gotoPageForm2(recid2) {
            axios.get('{{ route('index2') }}?recid=' + recid2)
                .then(response => {
                    // Handle the response
                    window.location.href = response.request.responseURL;
                })
                .catch(error => {
                    // Handle the error
                    console.error('There was an error!', error);
                });


        }
    </script>
</body>

</html>
