@extends('template.template')
@section('title', 'Master Rank')

@section('content')
    <h3 class="text-center" id="textheader"><i class="bi bi-person-fill-add fs-4 mx-2"></i>สร้างผู้อนุมัติตามลำดับในแผนก</h3>

    <div class="card mt-2">
        <div class="d-flex" id="form-content">
            <form action="" method="post" id="formApp" enctype=
            "multipart/form-data"
                class="needs-validation" novalidate>

                <div class="card-body">

                    <label for="" class="h5" style="color: #003f88;">Section:</label>
                    {{-- <select name="section_master" id="section_master" class="form-select form-control" required>
                        <option value="" selected disabled>Choose Section</option>
                        <option value="MT">MT</option>
                        <option value="AM">AM</option>
                        <option value="QA">QA</option>

                    </select> --}}
                    <input type="text" name="section_master" id="section_master" class="form-control" placeholder="กรอกแผนก" oninput="this.value = this.value.toUpperCase()">

                    <label for="" class="h5" style="color: #003f88;">Rank Approve:</label>
                    <select name="rank" id="rank" class="form-select form-control" required>
                        <option value="" selected disabled>Choose Rank</option>
                        <option value="A">Rank Approve A</option>
                        <option value="B">Rank Approve B</option>


                    </select>

                    <label for="" class="h5 mt-2" style="color: #003f88;">ผู้ตรวจสอบในแผนก:</label><br>
                    <select name="lv[1][]" id="lv1_app" class="form-select form-control" multiple required>
                    </select><br>

                    <label for="" class="h5 mt-2" style="color: #003f88;">ผู้อนุมัติในแผนกลำดับที่ 1:</label><br>
                    <select name="lv[2][]" id="lv2_app" class="form-select form-control" multiple required>
                    </select><br>
                    <label for="" class="h5 mt-2" style="color: #003f88;">ผู้อนุมัติในแผนกลำดับที่ 2:</label><br>
                    <select name="lv[3][]" id="lv3_app" class="form-select form-control" multiple required>
                    </select><br>
                    <label for="" class="h5 mt-2" style="color: #003f88;">QC Manager:</label><br>
                    <select name="lv[4][]" id="lv4_app" class="form-select form-control " multiple required>
                    </select><br>

                    <label for="" class="h5 mt-2" style="color: #003f88;">QC Executive</label><br>
                    <select name="lv[5][]" id="lv5_app" class="form-select form-control" required>
                    </select><br>




                    <input type="submit" value="สร้างผู้อนุมัติ" class="btn masterbtn mt-3">
                    <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                </div>
            </form>
        </div>


    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4>ข้อมูลลำดับการอนุมัติตามแผนก</h4>

        </div>
        <div class="card-body">
            <table class="table table-bordered nowrap w-100" id="master_db">
                <thead>
                    <tr>
                        <th style="background: #FFAF00; font-weight: 700;">Section</th>
                        <th style="background: #FFAF00; font-weight: 700;">Rank</th>
                        <th style="background: #FFAF00; font-weight: 700;">ลำดับอนุมัติ</th>
                        <th style="background: #FFAF00; font-weight: 700;">ผู้ตรวจสอบและอนุมัติ</th>

                    </tr>
                </thead>

                <tbody>

                </tbody>

            </table>
        </div>


    </div>
@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function() {
            $('#li-rank').addClass('active');

            //TODO: บันทึกข้อมูลและตรวจสอบการกรอกข้อมูล

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
                        event.preventDefault()
                        let newform = new FormData();
                        newform.append('formApp', $('#formApp').serialize())
                        newform.append('token', $('#token').val())

                        axios.post('{{ route('master') }}', newform)
                            .then(function(response) {
                                console.log(response)
                                if (response.data.success) {
                                    Swal.fire({
                                        title: 'สร้างสายอนุมัติสำเร็จ',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        location.reload();
                                    })
                                }
                            })

                    }

                    form.classList.add('was-validated')
                }, false)
            })

            $('#lv1_app').select2()
            $('#lv2_app').select2()
            $('#lv3_app').select2()
            $('#lv4_app').select2()
            $('#lv5_app').select2()

        })

        //TODO: show data from record data
        loadData();

        function loadData() {
            axios.get('{{ route('data.master') }}')
                .then(function(response) {
                    let html = '';
                    response.data.data.map((data) => {




                        html += '<tr>';
                        html += '<td style="font-weight: 700; font-size: 18px;">' + data
                            .LNCL_APP_SECTION +
                            '</td>';
                        html += '<td style="font-weight: 700; font-size: 18px;">' + data
                            .LNCL_RANKTYPE +
                            '</td>';
                        html += '<td style="font-weight: 700; font-size: 18px;">' + data
                            .LNCL_EMP_LEVEL +
                            '</td>';
                        html += '<td style="font-weight: 700; font-size: 18px;">' + data.empname +
                            '</td>';

                        html += '</tr>';


                    })


                    // Clear the DataTable if it already exists and add the new data
                    if ($.fn.DataTable.isDataTable('#master_db')) {
                        $('#master_db').DataTable().destroy();
                        $('#master_db tbody').empty();
                    }

                    // Update the table body with the generated HTML
                    $('#master_db tbody').html(html);

                    // Initialize DataTables with horizontal scroll
                    $('#master_db').DataTable({
                        scrollX: true,
                        scrollY: "50vh",
                        paging: false,
                        searching: false,
                        info: false,
                        responsive: true,

                    });
                }).catch(function(error) {
                    console.error('Error fetching names:', error);
                });

        }



        //TODO: get data to dropdownlist
        userApp1();
        userApp2();
        userApp3();
        userApp4();
        userApp5();

        function userApp1() {
            axios.get('{{ route('getUserWeb') }}')
                .then(function(response) {
                    var select = $("#lv1_app");
                    select.empty();
                    select.append('<option value="" selected disabled>-- เลือกผู้ตรวจสอบ --</option>');
                    response.data.us.forEach(function(user) {
                        // Trim spaces and ensure proper encoding

                        select.append(
                            `<option value="${user.MUSR_ID}">${user.MUSR_ID} ${user.MUSR_NAME}</option>`);
                    });
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        function userApp2() {
            axios.get('{{ route('getUserWeb') }}')
                .then(function(response) {
                    var select = $("#lv2_app");
                    select.empty();
                    select.append('<option value="" selected disabled>-- เลือกผู้อนุมัติในแผนกลำดับที่ 1 --</option>');
                    response.data.us.forEach(function(user) {
                        // Trim spaces and ensure proper encoding

                        select.append(
                            `<option value="${user.MUSR_ID}">${user.MUSR_ID} ${user.MUSR_NAME}</option>`);
                    });
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        function userApp3() {
            axios.get('{{ route('getUserWeb') }}')
                .then(function(response) {
                    var select = $("#lv3_app");
                    select.empty();
                    select.append('<option value="" selected disabled>-- เลือกผู้อนุมัติในแผนกลำดับที่ 2 --</option>');
                    response.data.us.forEach(function(user) {
                        // Trim spaces and ensure proper encoding

                        select.append(
                            `<option value="${user.MUSR_ID}">${user.MUSR_ID} ${user.MUSR_NAME}</option>`);
                    });
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        function userApp4() {
            axios.get('{{ route('getUserWeb') }}')
                .then(function(response) {
                    var select = $("#lv4_app");
                    select.empty();
                    select.append('<option value="" selected disabled>-- เลือกผู้อนุมัติ Semifinal --</option>');
                    response.data.us.forEach(function(user) {
                        // Trim spaces and ensure proper encoding

                        select.append(
                            `<option value="${user.MUSR_ID}">${user.MUSR_ID} ${user.MUSR_NAME}</option>`);
                    });
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        function userApp5() {
            axios.get('{{ route('getUserWeb') }}')
                .then(function(response) {
                    var select = $("#lv5_app");
                    select.empty();
                    select.append('<option value="" selected disabled>-- เลือกผู้อนุมัติ Final --</option>');
                    response.data.us.forEach(function(user) {
                        // Trim spaces and ensure proper encoding

                        select.append(
                            `<option value="${user.MUSR_ID}">${user.MUSR_ID} ${user.MUSR_NAME}</option>`);
                    });
                })
                .catch(function(error) {
                    console.error(error);
                });
        }


    </script>
@endpush
