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
                    <select name="section_master" id="section_master" class="form-select form-control" required>
                        <option value="" selected disabled>Choose Section</option>
                        <option value="MT">MT</option>
                        <option value="AM">AM</option>
                        <option value="QA">QA</option>

                    </select>

                    <label for="" class="h5" style="color: #003f88;">Rank Approve:</label>
                    <select name="rank" id="rank" class="form-select form-control" required>
                        <option value="" selected disabled>Choose Rank</option>
                        <option value="A">Rank Approve A</option>
                        <option value="B">Rank Approve B</option>


                    </select>

                    <label for="" class="h5 mt-2" style="color: #003f88;">ผู้ตรวจสอบในแผนก:</label><br>
                    <select name="lv[1][]" id="lv1_app" class="form-select form-control" multiple required>
                    </select><br>

                    <label for="" class="h5 mt-2" style="color: #003f88;">ผู้อนุมัติในแผนก:</label><br>
                    <select name="lv[2][]" id="lv2_app" class="form-select form-control" multiple required>
                    </select><br>
                    <label for="" class="h5 mt-2" style="color: #003f88;">QC Manager:</label><br>
                    <select name="lv[3][]" id="lv3_app" class="form-select form-control " multiple required>
                    </select><br>

                    <label for="" class="h5 mt-2" style="color: #003f88;">QC Executive</label><br>
                    <select name="lv[4][]" id="lv4_app" class="form-select form-control" required>
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
            <table class="table table-bordered" id="master_db">
                <thead>
                    <tr>
                        <th style="background: #FFAF00; font-weight: 700;">Section</th>
                        <th style="background: #FFAF00; font-weight: 700;">Rank</th>
                        <th style="background: #FFAF00; font-weight: 700;">ผู้ตรวจสอบในแผนก</th>
                        <th style="background: #FFAF00; font-weight: 700;">ผู้อนุมัติในแผนก</th>
                        <th style="background: #FFAF00; font-weight: 700;">ผู้อนุมัติก่อน Final</th>
                        <th style="background: #FFAF00; font-weight: 700;">Final Approve</th>
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

        })
        loadData();

        function loadData() {
            axios.get('{{ route('data.master') }}')
                .then(function(response) {
                    const data = response.data.data;

                    // Group data by LNCL_APP_SECTION and LNCL_RANKTYPE, and collect all LNCL_APP_EMPID values
                    const groupedData = data.reduce((acc, item) => {
                        const section = item.LNCL_APP_SECTION;
                        const rank = item.LNCL_RANKTYPE;
                        if (!acc[section]) {
                            acc[section] = {
                                A: [],
                                B: []
                            };
                        }
                        acc[section][rank].push(item.LNCL_APP_EMPID);
                        return acc;
                    }, {});

                    // Collect all unique EMPID values
                    const allEmpIds = [...new Set(data.flatMap(item => item.LNCL_APP_EMPID.split(',')))];

                    // Fetch names for all EMPID values
                    axios.get('{{ route('getUsershow') }}', {
                        params: {
                            empIds: allEmpIds
                        }
                    }).then(function(nameResponse) {
                        const names = nameResponse.data;

                        // Prepare table rows
                        let html = '';
                        for (const section in groupedData) {
                            if (groupedData.hasOwnProperty(section)) {
                                ['A', 'B'].forEach(rank => {
                                    if (groupedData[section][rank].length > 0) {
                                        const empIds = groupedData[section][rank];
                                        html += '<tr>';
                                        html +=
                                            `<td style="background: #f0f2ef; font-size: 20px; font-weight: 700;">${section}</td>`;
                                        html +=
                                            `<td style="background: #f0f2ef; font-size: 20px; font-weight: 700;">${rank}</td>`;

                                        // Add names for each EMPID in a column
                                        empIds.forEach(empId => {
                                            const empIdArray = empId.split(',');
                                            const empNames = empIdArray.map(id => names[id
                                                .trim()] || id).join(', ');
                                            html +=
                                                `<td style="background: #f0f2ef; font-size: 20px; font-weight: 700;">${empNames}</td>`;
                                        });

                                        html += '</tr>';
                                    }
                                });
                            }
                        }

                        // Update the table body with the generated HTML

                        $('#master_db tbody').html(html);
                        $('#master_db').DataTable({
                            scrollX: true,
                        });
                    }).catch(function(error) {
                        console.error('Error fetching names:', error);
                    });

                })
                .catch(function(error) {
                    console.error('Error loading data:', error);
                });
        }







        userApp1();
        userApp2();
        userApp3();
        userApp4();

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
                    select.append('<option value="" selected disabled>-- เลือกผู้อนุมัติในแผนก --</option>');
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
                    select.append('<option value="" selected disabled>-- เลือกผู้อนุมัติ Semi-final --</option>');
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
