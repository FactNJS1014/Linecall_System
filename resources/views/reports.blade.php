@extends('template.template')
@section('title', 'Reports')
@section('content')
    <h4 id="textheader" class="text-center"><i class="fa-solid fa-chart-pie fa-lg mx-3"></i>รายงานข้อมูล Linecall System</h4>
    {{-- <div class="clock">
        <span id="day"></span>
        <span>,</span>
        <span id="date" name="date"></span>
        <span id="hrs" class="ms-3">00</span>
        <span>:</span>
        <span id="min">00</span>
        <span>:</span>
        <span id="sec">00</span>
    </div> --}}
    <div class="row">
        {{-- <div class="col-md-6">
            <form method="get" id="dateform">
                <input type="date" name="datereport" id="datereport" class="form-control mb-3 mt-3">
            </form>
        </div> --}}
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control mb-3 mt-3" onkeyup="searchTable()"
                placeholder="Search for document number..">
        </div>
    </div>




    <div id="data_card" class="data-card mt-3">

    </div>



@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function() {
            $('#li-reports').addClass('active');
        })
        /**
         * TODO:02-08-2024
         * *Make Digital Clock
         */
        // let hrs = document.getElementById('hrs');
        // let min = document.getElementById('min');
        // let sec = document.getElementById('sec');
        // let dateDiv = document.getElementById('date');
        // let dayDiv = document.getElementById('day');
        // // Assuming there's an element with id 'message' to display the text
        // setInterval(() => {
        //     let currentTime = new Date();
        //     let h = currentTime.getHours();
        //     let m = currentTime.getMinutes();
        //     let s = currentTime.getSeconds();
        //     let d = currentTime.getDate();
        //     let mo = currentTime.getMonth() + 1; // Months are zero-based
        //     let y = currentTime.getFullYear();
        //     let dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        //     let day = dayNames[currentTime.getDay()];
        //     h = h < 10 ? '0' + h : h;
        //     m = m < 10 ? '0' + m : m;
        //     s = s < 10 ? '0' + s : s;
        //     hrs.innerHTML = h;
        //     min.innerHTML = m;
        //     sec.innerHTML = s;
        //     dateDiv.innerHTML = `${d}/${mo}/${y}`;
        //     dayDiv.innerHTML = day;

        // }, 1000);

        /**
         * TODO: 02-08-2024
         * *Show All Data reord
         */

        // const now = moment();
        // let date = now.format("YYYY-MM-DD");
        // let date_report = $('#datereport').val(date)

        // $('#datereport').on('change', function() {
        //     let daterep = $(this).val();
        //     showReport(daterep);
        // })
        showReport();

        function showReport() {

            //TODO: fetch data from database and from record
            axios.get('{{ route('datareport') }}')
                .then(function(res) {
                    console.log(res);
                    let card = '<div class="row">'; // เริ่มต้นแถวสำหรับแบ่งคอลัมน์
                    res.data.datafirst.map((show, index) => {
                        card += '<div class="col-md-6">' // กำหนดขนาดคอลัมน์
                        card += '<div class="card mt-3" style="background: #fff;">'
                        card += '<div class="card-body">'
                        card += '<table class="table table-bordered">'
                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">เลขที่เอกสาร</th>';
                        card +=
                            '<td class="doc-number" style="font-size: 20px; font-weight: 600; color: #172774;">' +
                            show.LNCL_HREC_REFDOC + '</td>';
                        card += '</tr>';
                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">แผนก</th>';
                        card +=
                            '<td class="section" style="font-size: 20px; font-weight: 600; color: #172774;">' +
                            show.LNCL_HREC_SECTION + '</td>';
                        card += '</tr>';
                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">ลูกค้า</th>';
                        if (show.LNCL_HREC_CUS === 'TCTC') {
                            card +=
                                '<td class="customer" style="font-size: 20px; font-weight: 600; color: #172774;">CTC</td>';
                        } else if (show.LNCL_HREC_CUS === 'TCTD') {
                            card +=
                                '<td class="customer" style="font-size: 20px; font-weight: 600; color: #172774;">CTD</td>';
                        } else {
                            card +=
                                '<td class="customer" style="font-size: 20px; font-weight: 600; color: #172774;">' +
                                show.LNCL_HREC_CUS + '</td>';
                        }

                        card += '</tr>';
                        card += '<tr>';
                        card +=
                            '<th style="width: auto; font-size: 20px; background: #172774; color: #fff; font-weight: 600;">NG Code</th>';
                        card += '<td style="font-size: 20px; font-weight: 600; color: #172774;">' + show
                            .LNCL_HREC_NGCD + '</td>';
                        card += '</tr>';
                        card += '</table>';
                        card += '<button class="btn btnviewrep ms-1 mb-1 mt-2" onclick=\'btnReport("' + show
                            .LNCL_HREC_ID +
                            '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>ดูรายงานข้อมูล</button>';
                        card += '</div>';
                        card += '</div>';
                        card += '</div>';

                        // เมื่อสองคอลัมน์เต็มแล้วให้ปิด row และเริ่มแถวใหม่
                        if ((index + 1) % 2 === 0) {
                            card += '</div><div class="row">';
                        }
                    });
                    card += '</div>'; // ปิดแถวสุดท้าย

                    $('#data_card').html(card); // Initial display
                });
        }








        //TODO: Search Data

        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const cards = document.querySelectorAll('.card');

            cards.forEach(card => {
                // Get text content of the card's table cells
                const docNo = card.querySelector('.doc-number') ? card.querySelector('.doc-number').textContent ||
                    '' : '';
                const customer = card.querySelector('.customer') ? card.querySelector('.customer').textContent ||
                    '' : '';
                const section = card.querySelector('.section') ? card.querySelector('.section').textContent ||
                    '' : '';

                // Check if either field matches the filter
                const isMatch = docNo.toUpperCase().indexOf(filter) > -1 || customer.toUpperCase().indexOf(filter) >
                    -1 || section.toUpperCase().indexOf(filter) > -1;

                card.style.display = isMatch ? '' : 'none';
            });
        }


        //TODO: Go to file DataReport


        btnReport = (recid) => {
            const url = `{{ route('data.report') }}?rec_id=${recid}`;
            const reports = window.open(url, '_blank');
            reports.onbeforeunload = function() {

                location.reload()
            }
        }
    </script>
@endpush
