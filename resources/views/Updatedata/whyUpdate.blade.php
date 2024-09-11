<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแก้ไขข้อมูล 5 Why</title>
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
    <div class="container mt-3">
        <h3 class="text-center mb-4" id="textheader"><i
                class="fa-solid fa-file-medical fa-lg mx-4"></i>แบบฟอร์มแก้ไขข้อมูล 5 Why
            Leak and Root</h3>


        <form method="post" id="leak_rec2" class="needs-validation" enctype=
            "multipart/form-data"
            novalidate>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label class="h5" style="color: #003f88;">รหัสพนักงาน:</label>
                    <input type="text" name="rec_empid" id="rec_empid" class="form-control"
                        placeholder="กรอกรหัสพนักงาน" required>
                </div>
                <div class="col-md-4">
                    <label class="h5" style="color: #003f88;">Name:</label>
                    <input type="text" name="rec_name" id="rec_name" class="form-control" placeholder="กรอก Name"
                        required>
                </div>
                <div class="col-md-4">
                    <label class="h5" style="color: #003f88;">Section:</label>
                    <select name="section_rec" id="section_rec" class="form-select form-control" required>
                        <option value="" selected disabled>เลือกแผนก</option>
                        <option value="MT">MT</option>
                        <option value="AM">AM</option>
                        <option value="QA">QA</option>

                    </select>
                </div>
            </div>
            <button type="button" class="btn btnviewData mt-3" onclick="viewleak()"><i
                    class="fa-solid fa-database mx-2"></i>แสดงข้อมูล 5 why of leak</button>
            <div class="card mt-3">
                <div class="p-2">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th style="background: #273642; color: #ffffff;">5 Why analysis of leak cause</th>

                                <th style="background: #273642; color: #ffffff;">Upload images</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea name="l_why1" id="l_why1" rows="3" class="form-control" style="font-size: 20px; font-weight: 700;"
                                        placeholder="why1" required></textarea>
                                </td>

                                <td rowspan="5"><input type="file" name="l_upload[]" id="l_upload"
                                        class="form-control" accept="image/*" multiple onchange="previewImages(event)">
                                    <div class="d-flex justify-content-center mt-2">
                                        <div id="imagePreview1" class="image-container"></div>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="l_why2" id="l_why2" rows="3" class="form-control" style="font-size: 20px; font-weight: 700;"
                                        placeholder="why2" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="l_why3" id="l_why3" rows="3" class="form-control" style="font-size: 20px; font-weight: 700;"
                                        placeholder="why3" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="l_why4" id="l_why4" rows="3" class="form-control" style="font-size: 20px; font-weight: 700;"
                                        placeholder="why4" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="l_why5" id="l_why5" rows="3" class="form-control"
                                        style="font-size: 20px; font-weight: 700;" placeholder="why5"></textarea>
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="4" style="background: #273642; color: #ffffff;">Action for Leak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5" colspan="4">
                                    <textarea name="action_l" id="action_l" rows="3" class="form-control"
                                        style="font-size: 20px; font-weight: 700;" placeholder="Action Leak" required></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>



            <div class="d-flex justify-content-center mt-3">

                <input type="button" value="อัพเดท Leak" class="btn btnedit p-2" id="UpdateLeak"
                    onclick="updateleak()">
            </div>


        </form>

        <form method="post" id="Root_rec2" class="needs-validation" enctype=
            "multipart/form-data"
            novalidate>
            <button type="button" class="btn btnviewData mt-3" onclick="viewRoot()"><i
                    class="fa-solid fa-database mx-2"></i>แสดงข้อมูล 5 why of Root</button>
            <div class="card mt-3">
                <div class="p-2">
                    <table class="table table-bordered mt-2">

                        <thead class="">
                            <tr>
                                <th style="background: #32576c; color: #ffffff;">5 Why analysis of Root cause</th>

                                <th style="background: #32576c; color: #ffffff;">Upload images</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea name="r_why1" id="r_why1" rows="3" class="form-control"
                                        style="font-size: 20px; font-weight: 700;" placeholder="why1" required></textarea>
                                </td>

                                <td rowspan="5"><input type="file" name="r_upload[]" id="r_upload"
                                        class="form-control" accept="image/*" multiple
                                        onchange="previewImages2(event)">
                                    <div class="d-flex justify-content-center mt-2">
                                        <div id="imagePreview2" class="image-container"></div>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="r_why2" id="r_why2" rows="3" class="form-control"
                                        style="font-size: 20px; font-weight: 700;" placeholder="why2" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="r_why3" id="r_why3" rows="3" class="form-control"
                                        style="font-size: 20px; font-weight: 700;" placeholder="why3" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="r_why4" id="r_why4" rows="3" class="form-control"
                                        style="font-size: 20px; font-weight: 700;" placeholder="why4" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="r_why5" id="r_why5" rows="3" class="form-control"
                                        style="font-size: 20px; font-weight: 700;" placeholder="why5"></textarea>
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="4" style="background: #32576c; color: #ffffff;">Action for Root</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5" colspan="4">
                                    <textarea name="action_r" id="action_r" rows="3" class="form-control"
                                        style="font-size: 20px; font-weight: 700;" placeholder="Action Root" required></textarea>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
            <div class="d-flex justify-content-center mt-3">

                <input type="button" value="อัพเดท Root" class="btn btnedit p-2" id="UpdateRoot"
                    onclick="updateDataRt()">
            </div>
        </form>
    </div>
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables.min.js') }}"></script>
    <script src="{{ asset('public/js/all.min.js') }}"></script>
    <script>
        /**
         * TODO: 25-07-2024
         * * show Preview Image
         *  */
        function previewImages(event) {
            var files = event.target.files;

            if (files.length > 3) {
                alert('You can only upload a maximum of 3 images');
                document.getElementById('l_upload').value = ''; // Clear the input
                return;
            }


            var container = document.getElementById('imagePreview1');
            container.innerHTML = ''; // Clear previous images

            Array.from(files).forEach(file => {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');
                        var maxWidth = 520; // Set the max width or height for the resized image
                        var maxHeight = 520;
                        var width = img.width;
                        var height = img.height;

                        if (width > height) {
                            if (width > maxWidth) {
                                height *= maxWidth / width;
                                width = maxWidth;
                            }
                        } else {
                            if (height > maxHeight) {
                                width *= maxHeight / height;
                                height = maxHeight;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;
                        ctx.drawImage(img, 0, 0, width, height);

                        var resizedImg = new Image();
                        resizedImg.src = canvas.toDataURL();
                        resizedImg.classList.add('image-preview');
                        resizedImg.addEventListener('click', function() {
                            this.classList.toggle('zoomed');
                        });
                        container.appendChild(resizedImg);

                    }
                };
                reader.readAsDataURL(file);
            });
        }

        function previewImages2(event) {
            var files = event.target.files;

            if (files.length > 3) {
                alert('You can only upload a maximum of 3 images');
                document.getElementById('r_upload').value = ''; // Clear the input
                return;
            }


            var container2 = document.getElementById('imagePreview2');
            container2.innerHTML = ''; // Clear previous images

            Array.from(files).forEach(file => {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');
                        var maxWidth = 520; // Set the max width or height for the resized image
                        var maxHeight = 520;
                        var width = img.width;
                        var height = img.height;

                        if (width > height) {
                            if (width > maxWidth) {
                                height *= maxWidth / width;
                                width = maxWidth;
                            }
                        } else {
                            if (height > maxHeight) {
                                width *= maxHeight / height;
                                height = maxHeight;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;
                        ctx.drawImage(img, 0, 0, width, height);

                        var resizedImg = new Image();
                        resizedImg.src = canvas.toDataURL();
                        resizedImg.classList.add('image-preview');
                        resizedImg.addEventListener('click', function() {
                            this.classList.toggle('zoomed');
                        });
                        container2.appendChild(resizedImg);

                    }
                };
                reader.readAsDataURL(file);
            });
        }

        function getQueryParam(param) {
            let urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }
        viewleak = () => {
            //$('#UpdateLeak').show();

            let recid = getQueryParam('recid');

            //alert(recid)
            axios.get('{{ route('get_editform2') }}', {
                    params: {
                        recid: recid
                    }
                })
                .then(function(response) {
                    console.log(response);
                    response.data.dataformsecond.map((second) => {
                        $('#rec_empid').val(second.LNCL_LEAKANDROOT_EMPID)
                        $('#rec_name').val(second.LNCL_LEAKANDROOT_NAME)
                        $('#section_rec').val(second.LNCL_LEAKANDROOT_SECTION)
                        $('#l_why1').val(second.LNCL_LEAK_WHY1)
                        $('#l_why2').val(second.LNCL_LEAK_WHY2)
                        $('#l_why3').val(second.LNCL_LEAK_WHY3)
                        $('#l_why4').val(second.LNCL_LEAK_WHY4)
                        $('#l_why5').val(second.LNCL_LEAK_WHY5)
                        $('#action_l').val(second.LNCL_LEAK_ACTION)

                    })
                })
        }



        function updateleak() {
            let recid = getQueryParam('recid');
            //let lform = $('#leak_rec').serialize();
            var images_l = $('#l_upload').prop('files');
            var formUpdate = new FormData();
            formUpdate.append('lform', $('#leak_rec').serialize());
            formUpdate.append('_token', '{{ csrf_token() }}');
            formUpdate.append('id', recid);
            for (let i = 0; i < images_l.length; i++) {
                formUpdate.append("filesup01[]", $('#l_upload').prop('files')[i]);
            }
            axios.post('{{ route('updateLeak') }}', formUpdate)
                .then(function(response) {
                    if (response.data.success) {
                        Swal.fire({
                            title: 'อัพเดทข้อมูลเสร็จสิ้น',
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            window.close();
                        })
                    }
                })

        }

        viewRoot = () => {
            //$('#UpdateRoot').show();

            let recid = getQueryParam('recid');

            //alert(recid)
            axios.get('{{ route('get_editform2') }}', {
                    params: {
                        recid: recid
                    }
                })
                .then(function(response) {
                    console.log(response);
                    response.data.dataformsecond.map((second) => {

                        $('#r_why1').val(second.LNCL_ESC_WHY1)
                        $('#r_why2').val(second.LNCL_ESC_WHY2)
                        $('#r_why3').val(second.LNCL_ESC_WHY3)
                        $('#r_why4').val(second.LNCL_ESC_WHY4)
                        $('#r_why5').val(second.LNCL_ESC_WHY5)
                        $('#action_r').val(second.LNCL_ESC_ACTION)
                    })
                })
        }

        updateDataRt = () => {
            let recid = getQueryParam('recid');
            let rform = $('#Root_rec').serialize();
            var images_r = $('#r_upload').prop('files');
            var formUpdate = new FormData();

            for (let i = 0; i < images_r.length; i++) {
                formUpdate.append("filesup02[]", images_r[i]);
            }
            formUpdate.append('rform', $('#Root_rec').serialize());
            formUpdate.append('_token', '{{ csrf_token() }}'); // Get CSRF token from meta tag
            formUpdate.append('id', recid);
            //alert(recid)
            axios.post('{{ route('updateRoot') }}', formUpdate)
                .then(function(response) {
                    if (response.data.up) {
                        Swal.fire({
                            title: 'อัพเดทข้อมูลเสร็จสิ้น',
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            window.close();
                        })
                    }
                })
        }
    </script>
</body>

</html>
