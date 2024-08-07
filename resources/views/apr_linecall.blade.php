@extends('template.template')
@section('title', 'Check list of Data')
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
                        '<div class="card mt-3" style="background:#fcf6bd; border-color: #335c67; border-width: 3px;">';
                    card += '<div class="p-2">'
                    card += '<div class="card-body" style="background:#fff;">'
                    card += '<div class="row" >'
                    card += '<div class="col-md-4">'
                    card += '<p class="textdata">เลขที่เอกสาร: <span class="data">' + show.LNCL_HREC_REFDOC +
                        '</span></p>'
                    card += '</div>';
                    card += '<div class="col-md-4">'
                    card += '<p class="textdata">Model Code: <span class="data">' + show.LNCL_HREC_MDLCD +
                        '</span></p>'
                    card += '</div>';
                    card += '<div class="col-md-4">'
                    card += '<p class="textdata">NG Code: <span class="data">' + show.LNCL_HREC_NGCD +
                        '</span></p>'
                    card += '</div>';
                    card += '</div>';
                    card += '<div class="row" >'
                    card += '<div class="col">'
                    card += '<p class="textdata">ปัญหาที่พบ: <span class="data">' + show.LNCL_HREC_PROBLEM +
                        '</span></p>'
                    card += '</div>';
                    card += '</div>';
                    card += '</div>';
                    card += '</div>';
                    card += '<button class="btn btnview ms-2 mb-2" onclick=\'btnviewdata("' + show
                        .LNCL_HREC_ID + '")\'><i class="fa-solid fa-eye fa-lg mx-2"></i>ตรวจสอบข้อมูล</button>';
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
