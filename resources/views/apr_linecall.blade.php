@extends('template.template')
@section('title', 'Check list of Data')
@section('content')
    <h4 id="textheader" class="text-center"><i class="fa-solid fa-check-to-slot fa-lg mx-4"></i>ส่วนอนุมัติข้อมูล Linecall</h4>

    <div class="card" style="background: #fff;">
        <div class="data-card" id="datacard">
        </div>
    </div>



@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function() {
            $('#li-approve').addClass('active');

        })

        //TODO: แสดงข้อมูลที่บันทึก

        axios.get('{{ route('data_first') }}')
            .then(function(res) {
                //console.log(res)
                let card = '';
                res.data.datafirst.map((show) => {
                    console.log(show.LNCL_HREC_ID);
                    //console.log(show)
                    const matchData = String(res.data.match); // Convert the match data to a string
                    const matchArray = matchData.split(','); // Split the string into an array

                    console.log(matchArray);
                    console.log(empno)
                    console.log(show.LNCL_HREC_EMPID);

                    if (matchArray.includes(empno)) {
                        // Declare 'card' variable to store HTML content

                        card += '<div class="p-2">';
                        card += '<div class="card-body" style="background:#fff;">';
                        card += '<table class="table table-bordered">';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">เลขที่เอกสาร</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_REFDOC + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">ลูกค้า</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_CUS + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">Work Order</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_WON + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">NG Code</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_NGCD + '</td>';
                        card += '</tr>';

                        card += '</table>';
                        card += '<p class="text-head">Problem:</p>';
                        card += '<p class="text-content">' + show.LNCL_HREC_PROBLEM + '</p>';

                        if (show.LNCL_HREC_RJSTD == 1) {
                            card += '<p class="text-head">Reject Remark (Comment):</p>';
                            card += '<p class="text-content">' + show.LNCL_HREC_RJREMARK + '</p>';
                        } else if (show.LNCL_HREC_RJSTD == 2) {
                            card += '<p class="text-noremark">มีการแก้ไขแล้ว</p>';
                        } else {
                            card += '<p class="text-noremark">ยังไม่มีการ Reject</p>';
                        }

                        card += '<button class="btn btnview ms-2 mb-2" onclick=\'btnviewdata("' + show
                            .LNCL_HREC_ID +
                            '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>ตรวจสอบข้อมูล</button>';
                        card += '</div>';
                        card += '</div>';



                        // Insert the card into the DOM or perform the desired action with it
                    } else {
                        console.log(
                            "empno not found in matchArray. Card not displayed."
                        ); // Optional: Log for debugging
                    }

                    let data02 = res.data.datasecond;

                    // Assuming data02 is an array of objects, and you want to extract 'someProperty'
                    let data03 = data02.map(item => item.LNCL_LEAKANDROOT_EMPID);

                    console.log(data03); // Output: Array of values corresponding to 'someProperty'
                    console.log(data03.includes(
                        empno)); // Output: Array of values corresponding to 'someProperty'


                    if (empno === show.LNCL_HREC_EMPID && show.LNCL_HREC_TRACKING == 0) {

                        card += '<div class="p-2">';
                        card += '<div class="card-body" style="background:#fff;">';
                        card += '<table class="table table-bordered">';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">เลขที่เอกสาร</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_REFDOC + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">ลูกค้า</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_CUS + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">Work Order</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_WON + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">NG Code</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_NGCD + '</td>';
                        card += '</tr>';

                        card += '</table>';
                        card += '<p class="text-head">Problem:</p>';
                        card += '<p class="text-content">' + show.LNCL_HREC_PROBLEM + '</p>';

                        if (show.LNCL_HREC_RJSTD == 1) {
                            card += '<p class="text-head">Reject Remark (Comment):</p>';
                            card += '<p class="text-content">' + show.LNCL_HREC_RJREMARK + '</p>';
                        } else {
                            card += '<p class="text-noremark">ยังไม่มีการ Reject</p>';
                        }

                        card += '<button class="btn btnview ms-2 mb-2" onclick=\'btnviewdata("' + show
                            .LNCL_HREC_ID +
                            '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>ตรวจสอบข้อมูล</button>';
                        card += '</div>';
                        card += '</div>';
                    } else if (data03.includes(empno) && show.LNCL_HREC_TRACKING == 0) {
                        card += '<div class="p-2">';
                        card += '<div class="card-body" style="background:#fff;">';
                        card += '<table class="table table-bordered">';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">เลขที่เอกสาร</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_REFDOC + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">ลูกค้า</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_CUS + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">Work Order</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_WON + '</td>';
                        card += '</tr>';

                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">NG Code</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_NGCD + '</td>';
                        card += '</tr>';

                        card += '</table>';
                        card += '<p class="text-head">Problem:</p>';
                        card += '<p class="text-content">' + show.LNCL_HREC_PROBLEM + '</p>';

                        if (show.LNCL_HREC_RJSTD == 1) {
                            card += '<p class="text-head">Reject Remark (Comment):</p>';
                            card += '<p class="text-content">' + show.LNCL_HREC_RJREMARK + '</p>';
                        } else {
                            card += '<p class="text-noremark">ยังไม่มีการ Reject</p>';
                        }

                        card += '<button class="btn btnview ms-2 mb-2" onclick=\'btnviewdata("' + show
                            .LNCL_HREC_ID +
                            '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>ตรวจสอบข้อมูล</button>';
                        card += '</div>';
                        card += '</div>';
                    }


                    $('#datacard').html(card)
                })


            })
        //TODO: open page with view data
        btnviewdata = (rec_id) => {
            console.log(rec_id)
            const url = `{{ route('data_record') }}?rec_id=${rec_id}`;
            const open = window.open(url, '_blank');
            open.onbeforeunload = function() {

                location.reload()
            }

        }


        // axios.get('{{ route('compareLevel') }}')
        //     .then(function(response) {
        //         console.log(response.data)


        //         let matchArray = response.data.match.split(',');

        //         console.log(matchArray);

        //         // Check if empno is in the array
        //         if (matchArray.includes(empno)) {
        //             console.log(`Employee number ${empno} is a match in LNCL_EMPID_RECAPP.`);
        //         } else {
        //             console.log(`No match found for employee number ${empno}.`);
        //         }

        //     })
    </script>
@endpush
