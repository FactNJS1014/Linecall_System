@extends('template.template')
@section('title', 'บันทึกฟอร์ม 2')
@section('content')
    <h3 class="text-center mb-4" id="textheader"><i class="fa-solid fa-file-medical fa-lg mx-4"></i>แบบฟอร์มบันทึกข้อมูล 5 Why
        Leak and Root</h3>
    <div class="p-2">
        <table class="table table-bordered" id="data_rec01">
            <thead class="table-dark">
                <tr>
                    <th>Section</th>
                    <th>Model Code</th>
                    <th>NG Code</th>
                    <th>NG Position</th>
                    <th>Show Form 5 Why </th>

                </tr>
            </thead>
            <tbody style="font-weight: bold; font-size: 22px">

            </tbody>
        </table>

    </div>

    <p id="text_id" style="font-size: 24px; font-weight: 700; color: #3a5a40; background: #fff;"></p>

    <form method="post" id="leak_rec" class="needs-validation" enctype=
        "multipart/form-data" novalidate>

        <div class="row mt-3">
            <div class="col-md-4">
                <label class="h5" style="color: #003f88;">รหัสพนักงาน:</label>
                <input type="text" name="rec_empid" id="rec_empid" class="form-control" placeholder="กรอกรหัสพนักงาน"
                    required>
            </div>
            <div class="col-md-4">
                <label class="h5" style="color: #003f88;">Name:</label>
                <input type="text" name="rec_name" id="rec_name" class="form-control" placeholder="กรอก Name" required>
            </div>
            <div class="col-md-4">
                <label class="h5" style="color: #003f88;">Section:</label>
                <select name="section_rec" id="section_rec" class="form-select form-control" required>
                    <option value="" selected disabled>เลือกแผนก</option>
                    <option value="MT">MT</option>
                    <option value="AM">AM</option>

                </select>
            </div>
        </div>
        <button type="button" class="btn btnviewdata mt-3" onclick="viewleak()">แสดงข้อมูล 5 why of leak</button>
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

                            <td rowspan="5"><input type="file" name="l_upload[]" id="l_upload" class="form-control"
                                    accept="image/*" multiple onchange="previewImages(event)">
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
                                <textarea name="l_why5" id="l_why5" rows="3" class="form-control" style="font-size: 20px; font-weight: 700;"
                                    placeholder="why5"></textarea>
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
                                <textarea name="action_l" id="action_l" rows="3" class="form-control" style="font-size: 20px; font-weight: 700;"
                                    placeholder="Action Leak" required></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>



        <div class="d-flex justify-content-center mt-3">
            <input type="submit" value="บันทึก Leak" class="btn savebtn p-2">
            <input type="button" value="อัพเดท Leak" class="btn btnedit p-2" id="UpdateLeak" onclick="updateleak()">
        </div>


    </form>

    <form method="post" id="Root_rec" class="needs-validation" enctype=
        "multipart/form-data" novalidate>
        <button type="button" class="btn btnviewdata mt-3" onclick="viewRoot()">แสดงข้อมูล 5 why of Root</button>
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
                                    class="form-control" accept="image/*" multiple onchange="previewImages2(event)">
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
            <input type="submit" value="บันทึก Root" class="btn savebtn p-2">
            <input type="button" value="อัพเดท Root" class="btn btnedit p-2" id="UpdateRoot" onclick="updateDataRt()">
        </div>
    </form>
@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function() {
            $('#li-record2').addClass('active');

            /**
             * TODO:26-07-2024
             * *Show data and click show form record (แสดงข้อมูลในแบบฟอร์มหลัก และคลิกปุ่มเพื่อบันทึกฟอร์มที่ 2)
             * */



            axios.get('{{ route('data_first') }}')
                .then(function(show) {
                    $('#leak_rec').hide()
                    $('#Root_rec').hide()
                    let html = '';
                    show.data.datafirst.map((list) => {
                        console.log(list)
                        html += '<tr id="row-' + list.LNCL_HREC_ID + '">'
                        html += '<td>' + list.LNCL_HREC_SECTION + '</td>'
                        html += '<td>' + list.LNCL_HREC_MDLCD + '</td>'
                        html += '<td>' + list.LNCL_HREC_NGCD + '</td>'
                        html += '<td>' + list.LNCL_HREC_NGPST + '</td>'
                        html += '<td><button class="btn btnview" onclick=\'btnview("' + list
                            .LNCL_HREC_ID + '","' + list.LNCL_HREC_SECTION +
                            '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>View Form</button></td>'

                        html += '<tr>'
                    })
                    $('#data_rec01 tbody').html(html);
                })


            let currentId = null;
            let currentsec = null;
            btnview = (id, sec) => {
                //alert(id)

                currentId = id;
                currentsec = sec;
                console.log('Viewing Form ID:', id);
                console.log('Viewing Form Section:', sec);

                // Show the forms
                $('#leak_rec').show();
                $('#Root_rec').show();

                // Reset forms
                $('#leak_rec').trigger("reset");
                $('#Root_rec').trigger("reset");

                $('#text_id').text('Section Record: ' + currentsec)

                /**
                 * TODO: Validate Form Data Record 3 Card
                 * * 12-07-2024
                 * */
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        } else {
                            event.preventDefault();
                            event.stopPropagation();

                            const form = event.target;
                            if (form.id === 'leak_rec') {
                                if (currentId, currentsec) {
                                    console.log('Submitting Leak Rec ID:', currentId);


                                    var images_l = $('#l_upload').prop('files');
                                    var formData1 = new FormData();

                                    for (let i = 0; i < images_l.length; i++) {
                                        formData1.append("filesup01[]", images_l[i]);
                                    }
                                    formData1.append('Leakdata', $('#leak_rec').serialize());
                                    var _token = $('meta[name="csrf-token"]').attr(
                                        'content'); // Get CSRF token from meta tag
                                    formData1.append("_token", _token);
                                    formData1.append("id", currentId);
                                    $.ajax({
                                        url: '{{ route('recordLeak') }}',
                                        type: 'post',
                                        data: formData1,
                                        contentType: false,
                                        processData: false,
                                        cache: false,
                                        beforeSend: function() {
                                            Swal.fire({
                                                title: "กำลังบันทึกข้อมูล",
                                                icon: "info",
                                                showConfirmButton: false,
                                                willOpen: () => {
                                                    Swal.showLoading();
                                                },
                                            });
                                        },
                                        success: function(res) {
                                            console.log(res)
                                            if (res.status === 'success') {
                                                Swal.fire({
                                                    title: 'บันทึกข้อมูลเสร็จสิ้น',
                                                    icon: "success",
                                                    showConfirmButton: false,
                                                    timer: 1000
                                                }).then((result) => {
                                                    $('#leak_rec').hide();
                                                })
                                            } else {
                                                Swal.fire({
                                                    title: 'ไม่สามารถบันทึกได้',
                                                    icon: "error",
                                                    showConfirmButton: false,
                                                    timer: 1000
                                                });
                                            }
                                        }
                                    });
                                }
                            } else if (form.id === 'Root_rec') {
                                if (currentId) {
                                    console.log('Submitting Root Rec ID:', currentId);
                                    var images_r = $('#r_upload').prop('files');
                                    var formData2 = new FormData();

                                    for (let i = 0; i < images_r.length; i++) {
                                        formData2.append("filesup02[]", images_r[i]);
                                    }
                                    formData2.append('Rootdata', $('#Root_rec').serialize());
                                    var _token = $('meta[name="csrf-token"]').attr(
                                        'content'); // Get CSRF token from meta tag
                                    formData2.append("_token", _token);
                                    formData2.append("id", currentId);
                                    //$('#Root_rec').hide();

                                    $.ajax({
                                        url: '{{ route('recordRoot') }}',
                                        type: 'post',
                                        data: formData2,
                                        contentType: false,
                                        processData: false,
                                        cache: false,
                                        beforeSend: function() {
                                            Swal.fire({
                                                title: "กำลังบันทึกข้อมูล",
                                                icon: "info",
                                                showConfirmButton: false,
                                                willOpen: () => {
                                                    Swal.showLoading();
                                                },
                                            });
                                        },
                                        success: function(res) {
                                            console.log(res);
                                            if (res.form2) {
                                                Swal.fire({
                                                    title: 'บันทึกข้อมูลเสร็จสิ้น',
                                                    icon: "success",
                                                    showConfirmButton: false,
                                                    timer: 1000
                                                });
                                            } else {
                                                Swal.fire({
                                                    title: 'ไม่สามารถบันทึกได้',
                                                    icon: "error",
                                                    showConfirmButton: false,
                                                    timer: 1000
                                                });
                                            }
                                        }
                                    });
                                }
                            }

                        }


                        form.classList.add('was-validated')
                    }, false)
                })


            }




        })

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

        $('#UpdateLeak').hide();
        $('#UpdateRoot').hide();

        viewleak = () => {
            $('#UpdateLeak').show();

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

        function getQueryParam(param) {
            let urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        function updateleak() {
            let recid = getQueryParam('recid');
            let lform = $('#leak_rec').serialize();

            axios.post('{{ route('updateLeak') }}', {
                    recid: recid,
                    lform: lform
                })
                .then(function(response) {
                    if (response.data.success) {
                        Swal.fire({
                            title: 'อัพเดทข้อมูลเสร็จสิ้น',
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                })

        }

        viewRoot = () => {
            $('#UpdateRoot').show();

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
            //alert(recid)
            axios.post('{{ route('updateRoot') }}', {
                    recid: recid,
                    rform: rform
                })
                .then(function(response) {
                    if (response.data.up) {
                        Swal.fire({
                            title: 'อัพเดทข้อมูลเสร็จสิ้น',
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                })
        }
    </script>
@endpush
