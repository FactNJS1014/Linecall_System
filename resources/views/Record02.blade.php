@extends('template.template')
@section('title','Linecall-02')
@section('content')
    <h3 class="text-center mb-4" id="textheader"><i class="fa-solid fa-file-medical fa-lg mx-4"></i>แบบฟอร์มบันทึกข้อมูลปัญหาและการหลุดรอย</h3>
    <form action="" id="leak_rec" class="needs-validation" novalidate>
        <div class="row mt-3">
            <div class="col-md-4">
                <label class="h5" style="color: #003f88;">รหัสพนักงาน:</label>
                <input type="text" name="rec_empid" id="rec_empid" class="form-control" placeholder="กรอกรหัสพนักงาน" required>
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
                        <td><textarea name="l_why1" id="l_why1"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why1" required></textarea></td>

                        <td rowspan="5"><input type="file"name="l_upload"id="l_upload"class="form-control" onchange="previewImage(event)">
                            <div class="d-flex justify-content-center mt-2">
                                <img src="" id="imagePreview" alt="" width="500px">

                            </div></td>
                    </tr>
                    <tr>
                        <td><textarea name="l_why2" id="l_why2"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why2" required></textarea></td>
                    </tr>
                    <tr>
                        <td><textarea name="l_why3" id="l_why3"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why3" required></textarea></td>
                    </tr>
                    <tr>
                        <td><textarea name="l_why4" id="l_why4"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why4" required></textarea></td>
                    </tr>
                    <tr>
                        <td><textarea name="l_why5" id="l_why5"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why5"></textarea></td>
                    </tr>
                    </tbody>
                    <thead>
                    <tr>
                        <th colspan="4" style="background: #273642; color: #ffffff;">Action for Leak</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td rowspan="5" colspan="4"><textarea name="action_l" id="action_l"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="Action Leak" required></textarea></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>



        <div class="d-flex justify-content-center mt-3">
            <input type="submit" value="บันทึก Leak" class="btn savebtn p-2">
        </div>


    </form>

    <form action="" id="Root_rec" class="needs-validation" novalidate>
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
                        <td><textarea name="r_why1" id="r_why1"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why1" required></textarea></td>

                        <td rowspan="5"><input type="file"name="r_upload"id="r_upload"class="form-control" onchange="previewImage(event)">
                            <div class="d-flex justify-content-center mt-2">
                                <img src="" id="imagePreview" alt="" width="500px">

                            </div></td>
                    </tr>
                    <tr>
                        <td><textarea name="r_why2" id="r_why2"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why2" required></textarea></td>
                    </tr>
                    <tr>
                        <td><textarea name="r_why3" id="r_why3"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why3" required></textarea></td>
                    </tr>
                    <tr>
                        <td><textarea name="r_why4" id="r_why4"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why4" required></textarea></td>
                    </tr>
                    <tr>
                        <td><textarea name="r_why5" id="r_why5"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="why5" ></textarea></td>
                    </tr>
                    </tbody>
                    <thead>
                    <tr>
                        <th colspan="4" style="background: #32576c; color: #ffffff;">Action for Root</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td rowspan="5" colspan="4"><textarea name="action_l" id="action_l"  rows="3" class="form-control" style="font-size: 20px; font-weight: 700;" placeholder="Action Root" required></textarea></td>
                    </tr>
                    </tbody>

                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            <input type="submit" value="บันทึก Root" class="btn savebtn p-2">
        </div>
    </form>
@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function () {
            $('#li-record2').addClass('active');

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
                        if (form.id === 'prbandesc') {
                            alert('The form with id "gen_record" is fully filled out and validated!');
                        }

                    }


                    form.classList.add('was-validated')
                }, false)
            })


        })
        /**
         * TODO: 12-07-2024
         * * show Preview Image
         *  */
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block'; // Show the image preview
            };
            reader.readAsDataURL(event.target.files[0]);
        }
        document.getElementById('imagePreview').addEventListener('click', function() {
            this.classList.toggle('zoomed');
        });




    </script>
@endpush
