@extends('template.template')
@section('title', 'Approve Data')
@section('content')
    <h4 id="textheader" class="text-center"><i class="fa-solid fa-check-to-slot fa-lg mx-4"></i>ส่วนอนุมัติข้อมูล Linecall</h4>

    <div class="data-card" id="datacard">
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
                    card +=
                        '<div class="card mt-3" style="background:#8d99ae; border-color: #335c67; border-width: 3px;">';
                    card += '<div class="p-2">'
                    card += '<table class="table table-bordered">'
                    card += '<thead>'
                    card += '<tr>'
                    card +=
                        '<th style="background: #2b2d42; color: #fff; font-size: 22px; font-weight: bold;">เลขที่เอกสาร</th>'
                    card +=
                        '<th style="background: #2b2d42; color: #fff; font-size: 22px; font-weight: bold;">Model Code</th>'
                    card +=
                        '<th style="background: #2b2d42; color: #fff; font-size: 22px; font-weight: bold;">Customer</th>'
                    card += '</tr>'
                    card += '</thead>'
                    card += '<tbody>'
                    card += '<tr>'
                    card += '<td style="font-size: 22px; font-weight: bold;">' + show.LNCL_HREC_REFDOC + '</td>'
                    card += '<td style="font-size: 22px; font-weight: bold;">' + show.LNCL_HREC_MDLCD + '</td>'
                    card += '<td style="font-size: 22px; font-weight: bold;">' + show.LNCL_HREC_CUS + '</td>'
                    card += '</tr>'
                    card += '</tbody>'
                    card += '<thead>'
                    card += '<tr>'
                    card +=
                        '<th colspan="3" style="background: #2b2d42; color: #fff; font-size: 22px; font-weight: bold;">Problem</th>'
                    card += '</tr>'
                    card += '</thead>'
                    card += '<tbody>'
                    card += '<tr>'
                    card +=
                        '<td colspan="3"><textarea class="form-control" rows="3" style="font-size: 22px; font-weight: bold;">' +
                        show.LNCL_HREC_PROBLEM + '</textarea></td>'
                    card += '</tr>'
                    card += '</tbody>'
                    card += '</table>'
                    card += '</div>';
                    card += '<button class="btn btnview ms-1 mb-1" onclick=\'btnviewdata("' + show
                        .LNCL_HREC_ID + '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>ดูข้อมูล</button>';
                    card += '</div>';
                })

                $('#datacard').html(card)
            })

        btnviewdata = (rec_id) => {
            console.log(rec_id)
            const url = `{{ route('data_record') }}?rec_id=${rec_id}`;
            window.open(url, '_blank');

        }
    </script>
@endpush
