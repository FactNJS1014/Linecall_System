@extends('template.template')
@section('title','Linecall-01')
@section('content')
    <div class="container mt-3">
        <h3 class="text-center mb-2" id="textheader"><i class="fa-solid fa-file-medical fa-lg mx-4"></i>แบบฟอร์มบันทึกข้อมูล Line-call Production</h3>
        <form action="" class="needs-validation" id="gen_record" novalidate>
            @csrf
            <div class="card border-dark active" id="card1" >
                <div class="card-header">
                    <p class="fs-5 mt-2">ส่วนบันทึกข้อมูลทั่วไป</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">วันที่ปัจจุบัน</label>
                            <input type="date" name="datenow" id="datenow" class="form-control fs-5" style="font-weight: 700">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">รหัสพนักงาน:</label>
                            <input type="text" name="empid" id="empid" class="form-control" placeholder="กรอกรหัสพนักงาน" required>
                        </div>

                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Line Production:</label>
                            <select class="form-select form-control" id="line" name="line" required>
                                <option value="" selected disabled>เลือกไลน์ผลิต</option>
                                <optgroup label="Line-MT" class="line1">
                                    <option value="MT-1">MT-1</option>
                                    <option value="MT-2">MT-2</option>
                                    <option value="MT-3">MT-3</option>
                                    <option value="MT-4">MT-4</option>
                                    <option value="MT-5">MT-5</option>
                                    <option value="MT-6">MT-6</option>
                                    <option value="MT-7">MT-7</option>
                                    <option value="MT-8">MT-8</option>
                                    <option value="MT-9">MT-9</option>
                                    <option value="MT-10">MT-10</option>
                                    <option value="MT-11">MT-11</option>
                                    <option value="MT-12">MT-12</option>
                                    <option value="MT-13">MT-13</option>
                                    <option value="MT-14">MT-14</option>
                                    <option value="MT-15">MT-15</option>
                                </optgroup>
                                <optgroup label="Line-SMT" class="line2">
                                    <option value="SMT-1">SMT-1</option>
                                    <option value="SMT-2">SMT-2</option>
                                    <option value="SMT-3">SMT-3</option>
                                    <option value="SMT-4">SMT-4</option>
                                    <option value="SMT-5">SMT-5</option>
                                    <option value="SMT-6">SMT-6</option>
                                    <option value="SMT-7">SMT-7</option>
                                    <option value="SMT-8">SMT-8</option>
                                    <option value="SMT-9">SMT-9</option>
                                    <option value="SMT-10">SMT-10</option>
                                    <option value="SMT-11">SMT-11</option>
                                    <option value="SMT-12">SMT-12</option>
                                    <option value="SMT-13">SMT-13</option>
                                    <option value="SMT-14">SMT-14</option>
                                    <option value="SMT-15">SMT-15</option>
                                    <option value="SMT-16">SMT-16</option>
                                    <option value="SMT-17">SMT-17</option>
                                    <option value="SMT-18">SMT-18</option>
                                    <option value="SMT-19">SMT-19</option>
                                    <option value="SMT-20">SMT-20</option>
                                </optgroup>
                                <optgroup label="Line-AV" class="line3">
                                    <option value="AV-1">AV-1</option>
                                    <option value="AV-2">AV-2</option>
                                    <option value="AV-3">AV-3</option>
                                    <option value="AV-4">AV-4</option>
                                </optgroup>
                                <optgroup label="Line-RH" class="line4">
                                    <option value="RH-1">RH-1</option>
                                    <option value="RH-2">RH-2</option>
                                    <option value="RH-3">RH-3</option>
                                    <option value="RH-4">RH-4</option>
                                    <option value="RH-5">RH-5</option>
                                </optgroup>
                                <optgroup label="TPP" class="line5">
                                    <option value="TPP">TPP</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Customer:</label>
                            <input type="text" name="customer" id="customer" class="form-control" placeholder="เลือกลูกค้า" required>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Work Order:</label>
                            <input type="text" name="won" id="won" class="form-control" placeholder="กรอก Work-Order" required>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Model Code:</label>
                            <input type="text" name="mdlcd" id="mdlcd" class="form-control" placeholder="กรอก Model Code" required>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Model Name:</label>
                            <input type="text" name="mdlnm" id="mdlnm" class="form-control" placeholder="Model Name" required>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">NG Code:</label>
                            <input type="text" name="ng_code" id="ng_code" class="form-control" placeholder="กรอก NG Code" required>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">NG Process:</label>
                            <input type="text" name="ng_prc" id="ng_prc" class="form-control" placeholder="กรอก NG Process" required>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Qty (จำนวนงานที่ผลิตทั้งหมด):</label>
                            <input type="number" name="qty" id="qty" class="form-control" placeholder="กรอก QTY" oninput="calculate()" required>
                        </div>
                    </div>
                    <div class="row mt-2">

                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Defict (จำนวนงานเสีย):</label>
                            <input type="number" name="defict" id="defict" class="form-control" placeholder="กรอก Defict" oninput="calculate()" required>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Percentage (%):</label>
                            <input type="number" name="percent" id="percent" class="form-control" placeholder="คิดเป็น %"  required>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Rank:</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input input-check" type="radio" name="type" id="type1">
                                    <label class="form-check-label fs-5 ms-1" for="flexRadioDefault1" style="color: #003f88;">
                                        A
                                    </label>
                                </div>
                                <div class="form-check ms-5">
                                    <input class="form-check-input input-check" type="radio" name="type" id="type2">
                                    <label class="form-check-label fs-5 ms-1" for="flexRadioDefault2" style="color: #003f88;">
                                        B
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">NG Position:</label>
                            <input type="text" name="ng_pst" id="ng_pst" class="form-control" placeholder="กรอก NG Position" required>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Serial No.:</label>
                            <input type="text" name="serial" id="serial" class="form-control" placeholder="กรอก Serial" required>
                        </div>
                        <div class="col-md-4">
                            <label class="h5" style="color: #003f88;">Ref-Document:</label>
                            <input type="number" name="doc" id="doc" class="form-control" placeholder="กรอกเลขเอกสาร" required>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="p-2">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="50%" style="background: #273642; color: #ffffff;">Problem</th>
                                    <th style="background: #273642; color: #ffffff;">Upload Image</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <textarea name="problem" id="problem" rows="5" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="ระบุปัญหา" required></textarea></td>
                                    <td>
                                        <input type="file" name="images[]" id="imageInput" accept="image/*" multiple onchange="previewImages(event)">
                                        <div class="d-flex justify-content-center mt-2">
                                            <div id="imageContainer" class="image-container"></div>

                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="h5" style="color: #003f88;">Cause:</label>
                            <textarea name="cause" id="cause" rows="5" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="ระบุสาเหตุ" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="h5" style="color: #003f88;">Temporary action:</label>
                            <textarea name="action" id="action" rows="5" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="ระบุ action" required></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" value="บันทึก" class="btn submitbtn mt-3">

                    </div>

                </div>
            </div>
        </form>


    </div>

@endsection

@push('script_content')
    <script !src="">

        $(document).ready(function(){
            $('#li-record').addClass('active')

            $('.next-btn').click(function(e){
                e.preventDefault();
                e.stopPropagation();
                var nextCard = $(this).data('next');
                $('.card').removeClass('active');
                $('#' + nextCard).addClass('active');
            });

            $('.back-btn').click(function(e){
                e.preventDefault();
                e.stopPropagation();
                var prevCard = $(this).data('back');
                $('.card').removeClass('active');
                $('#' + prevCard).addClass('active');
            });


            /**
             * TODO: Validate Form Data Record 3 Card
             * * 12-07-2024
             * */
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                        Swal.fire({
                            title: 'กรอกข้อมูลด้วยนะ',
                            icon: "warning"
                        })
                    }else{
                        event.preventDefault()
                        event.stopPropagation()
                        $.ajax({
                            url: '{{route('recordPrb')}}',
                            method: 'post',
                            data: $('#gen_record').serialize(),
                            dataType: 'json',
                            beforeSend() {
                                Swal.fire({
                                    title: "กำลังบันทึกข้อมูล",
                                    icon: "info",
                                    showConfirmButton: false,
                                    // timer: 1000,
                                    willOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            },
                            success: function(data) {
                                console.log(data)
                                // Swal.close()
                                // if (data.insert && data.images) {
                                //     Swal.fire({
                                //         title: "บันทึกข้อมูลสำเร็จ",
                                //         icon: "success",
                                //         showConfirmButton: false,
                                //         timer: 1000,
                                //     });
                                // } else{
                                //     Swal.fire({
                                //         title: "ไม่สามารถบันทึกได้",
                                //         icon: "error",
                                //         showConfirmButton: false,
                                //         timer: 6000,
                                //     });
                                // }
                            }

                        })

                    }


                    form.classList.add('was-validated')
                }, false)
            })



        });

        /**
         * TODO: 12-07-2024
         * * show Preview Image
         *  */
        function previewImages(event) {
            var files = event.target.files;

            if (files.length > 3) {
                alert('You can only upload a maximum of 3 images');
                document.getElementById('imageInput').value = ''; // Clear the input
                return;
            }

            var container = document.getElementById('imageContainer');
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

        /**
         * TODO: 16-07-2024
         * * calculate percentage
         * */

        function calculate(){
            var input1 = document.getElementById('qty').value;
            var input2 = document.getElementById('defict').value;
            var percent = (input2/input1)*100;
            if (!isNaN(percent)){
                document.getElementById('percent').value = parseFloat(percent).toFixed(2);
            }else{
                document.getElementById('percent').value = "";

            }

        }

        /**
         * TODO:18-07-2024
         * ?show date moment input date
         * */
        var currentDate = new Date();
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1; // เพิ่ม 1 เนื่องจากเดือนเริ่มที่ 0
        var year = currentDate.getFullYear();

        var formattedDate =
            year +
            "-" +
            (month < 10 ? "0" + month : month) +
            "-" +
            (day < 10 ? "0" + day : day);

        document.getElementById("datenow").value = formattedDate;




    </script>
@endpush
