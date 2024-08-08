@extends('template.template')
@section('title', 'Check list of Data')
@section('content')
    <h4 id="textheader" class="text-center"><i class="fa-solid fa-check-to-slot fa-lg mx-4"></i>ส่วนอนุมัติข้อมูล Linecall</h4>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-12">
            <div class="card" style="background: #fff;">
                <div class="data-card" id="datacard">
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function() {
            $('#li-approve').addClass('active');

        })

        axios.get('{{ route('data_first') }}')
            .then(function(res) {
                //console.log(res)
                let card = '';
                res.data.datafirst.map((show) => {
                    //console.log(show)

                    card += '<div class="p-2">'
                    card += '<div class="card-body" style="background:#fff;">'
                    card += '<table class="table table-bordered">'
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
                    card += '<p class="text-head">Problem:</p>'
                    card += '<p class="text-content">' + show.LNCL_HREC_PROBLEM + '</p>'
                    card += '<button class="btn btnview ms-2 mb-2" onclick=\'btnviewdata("' + show
                        .LNCL_HREC_ID + '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>ตรวจสอบข้อมูล</button>';
                    card += '</div>';
                    card += '</div>';
                })

                $('#datacard').html(card)
            })

        btnviewdata = (rec_id) => {
            console.log(rec_id)
            const url = `{{ route('data_record') }}?rec_id=${rec_id}`;
            window.open(url, '_blank');
            location.reload()
        }
    </script>
@endpush
