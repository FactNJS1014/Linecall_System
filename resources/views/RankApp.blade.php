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

                    </select>


                    <label for="" class="h5 mt-2" style="color: #003f88;">ผู้ตรวจสอบในแผนก:</label>
                    <select name="lv[1][]" id="lv1_app" class="form-select form-control p-2 " multiple
                        aria-label="Multiple select example" required>
                        <option value="" selected disabled>เลือกผู้ตรวจสอบในแผนก</option>
                        <option value="H0001">John</option>
                        <option value="H0002">Rock</option>
                        <option value="H0003">Amy</option>
                        <option value="H0004">Baller</option>
                        <option value="H0005">Milla</option>
                        <option value="H0006">Soona</option>
                        <option value="H0007">Joe</option>

                    </select>

                    <label for="" class="h5 mt-2" style="color: #003f88;">ผู้อนุมัติในแผนก:</label>
                    <select name="lv[2][]" id="lv1_app" class="form-select form-control p-2 " multiple
                        aria-label="Multiple select example" required>
                        <option value="" selected disabled>เลือกผู้อนุมัติในแผนก:</option>
                        <option value="K0001">Koii</option>
                        <option value="K0002">Lion</option>
                        <option value="K0003">Tiger</option>
                        <option value="K0004">Piglet</option>


                    </select>
                    <label for="" class="h5 mt-2" style="color: #003f88;">QC Manager:</label>
                    <select name="lv[3][]" id="lv1_app" class="form-select form-control p-2 " required>

                        <option value="1000222">P'Eak</option>


                    </select>

                    <label for="" class="h5 mt-2" style="color: #003f88;">QC Executive</label>
                    <select name="lv[4][]" id="lv1_app" class="form-select form-control p-2 " required>

                        <option value="1660006">P'Keng</option>


                    </select>




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
                        <th style="background: #FFAF00; font-weight: 700;">ผู้ตรวจสอบในแผนก</th>
                        <th style="background: #FFAF00; font-weight: 700;">ผู้อนุมัติในแผนก</th>
                        <th style="background: #FFAF00; font-weight: 700;">ผู้อนุมัติคนที่ 4</th>
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
                                        title: 'สร้าสายอนุมัติสำเร็จ',
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

        })
        loadData();

        function loadData() {
            axios.get('{{ route('data.master') }}')
                .then(function(response) {
                    console.log(response.data.data)
                    const data = response.data.data;

                    // Group data by `LNCL_APP_SECTION` and combine all `LNCL_APP_EMPID` values
                    const groupedData = data.reduce((acc, item) => {
                        if (!acc[item.LNCL_APP_SECTION]) {
                            acc[item.LNCL_APP_SECTION] = [];
                        }
                        // Append EMPID values to the section
                        acc[item.LNCL_APP_SECTION].push(item.LNCL_APP_EMPID);
                        return acc;
                    }, {});

                    // Determine the maximum number of EMPID columns needed
                    const maxEmpColumns = Math.max(...Object.values(groupedData).map(ids => ids.length));

                    // Prepare table rows
                    let html = '';
                    Object.keys(groupedData).forEach(section => {
                        const empIds = groupedData[section];

                        html += '<tr>';
                        html +=
                            `<td style="background: #f0f2ef; font-size: 20px; font-weight: 700;">${section}</td>`;
                        // Add each EMPID as a single string in its own column
                        for (let i = 0; i < maxEmpColumns; i++) {
                            html +=
                                `<td style="background: #f0f2ef; font-size: 20px; font-weight: 700;">${empIds[i] || ''}</td>`;
                        }
                        html += '</tr>';
                    });

                    $('#master_db tbody').html(html)
                })
        }
    </script>
@endpush
