@extends('template.template')
@section('title', 'Reports')
@section('content')
    <h4 id="textheader" class="text-center"><i class="fa-solid fa-chart-pie fa-lg mx-3"></i>รายงานข้อมูล Linecall System</h4>
    <div class="clock">
        <span id="day"></span>
        <span>,</span>
        <span id="date" name="date"></span>
        <span id="hrs" class="ms-3">00</span>
        <span>:</span>
        <span id="min">00</span>
        <span>:</span>
        <span id="sec">00</span>
    </div>
    <input type="text" id="searchInput" class="form-control mb-3 mt-3" onkeyup="searchTable()"
        placeholder="Search for document number..">

    <div class="data_card">

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
        let hrs = document.getElementById('hrs');
        let min = document.getElementById('min');
        let sec = document.getElementById('sec');
        let dateDiv = document.getElementById('date');
        let dayDiv = document.getElementById('day');
        // Assuming there's an element with id 'message' to display the text
        setInterval(() => {
            let currentTime = new Date();
            let h = currentTime.getHours();
            let m = currentTime.getMinutes();
            let s = currentTime.getSeconds();
            let d = currentTime.getDate();
            let mo = currentTime.getMonth() + 1; // Months are zero-based
            let y = currentTime.getFullYear();
            let dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            let day = dayNames[currentTime.getDay()];
            h = h < 10 ? '0' + h : h;
            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            hrs.innerHTML = h;
            min.innerHTML = m;
            sec.innerHTML = s;
            dateDiv.innerHTML = `${d}/${mo}/${y}`;
            dayDiv.innerHTML = day;

        }, 1000);

        /**
         * TODO: 02-08-2024
         * *Show All Data reord
         */


        axios.get('{{ route('data_first') }}')
            .then(function(res) {
                //console.log(res)
                let card = '';
                res.data.datafirst.map((show) => {
                    //console.log(show)
                    card +=
                        '<div class="card mt-3" style="background:#FFCF96; border-color: #335c67; border-width: 3px;">';
                    card += '<div class="p-2" id="card-data">'
                    card += '<div class="row">'
                    card += '<div class="col-md-6">'
                    card += '<p class="textdata">เลขที่เอกสาร: <span class="data">' + show.LNCL_HREC_REFDOC +
                        '</span></p>'
                    card += '<p class="textdata">รหัสพนักงาน: <span class="data">' + show.LNCL_HREC_EMPID +
                        '</span></p>'
                    card += '<p class="textdata">แผนก: <span class="data">' + show.LNCL_HREC_SECTION +
                        '</span></p>'
                    card += '<p class="textdata">Line: <span class="data">' + show.LNCL_HREC_LINE +
                        '</span></p>'
                    card += '<p class="textdata">ลูกค้า: <span class="data">' + show.LNCL_HREC_CUS +
                        '</span></p>'
                    card += '<p class="textdata">Work Order: <span class="data">' + show.LNCL_HREC_WON +
                        '</span></p>'
                    card += '<p class="textdata">Model Code: <span class="data">' + show.LNCL_HREC_MDLCD +
                        '</span></p>'
                    card += '<p class="textdata">Model Name: <span class="data">' + show.LNCL_HREC_MDLNM +
                        '</span></p>'
                    card += '</div>';
                    card += '<div class="col-md-6">'
                    card += '<p class="textdata">NG Code: <span class="data">' + show.LNCL_HREC_NGCD +
                        '</span></p>'
                    card += '<p class="textdata">NG Process: <span class="data">' + show.LNCL_HREC_NGPRCS +
                        '</span></p>'
                    card += '<p class="textdata">QTY: <span class="data">' + show.LNCL_HREC_QTY +
                        '</span></p>'
                    card += '<p class="textdata">Defict: <span class="data">' + show.LNCL_HREC_DEFICT +
                        '</span></p>'
                    card += '<p class="textdata">Percent: <span class="data">' + show.LNCL_HREC_PERCENT +
                        '</span></p>'
                    card += '<p class="textdata">NG Position: <span class="data">' + show.LNCL_HREC_NGPST +
                        '</span></p>'
                    card += '<p class="textdata">Serial: <span class="data">' + show.LNCL_HREC_SERIAL +
                        '</span></p>'

                    card += '</div>';
                    card += '</div>';
                    card += '</div>';
                    card += '<button class="btn btnviewrep ms-1 mb-1 mt-2" onclick=\'btnReport("' + show
                        .LNCL_HREC_ID +
                        '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>ดูข้อมูล</button>';
                    card += '</div>';

                })


                $('.data_card').html(card); // Initial display

            })



        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const txtValue = card.textContent || card.innerText;
                card.style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? '' : 'none';
            });
        }

        /***
         * TODO: 02-08-2024
         * *Go to file DataReport
         */

        btnReport = (recid) => {
            const url = `{{ route('data.report') }}?rec_id=${recid}`;
            window.open(url, '_blank');
        }
    </script>
@endpush
