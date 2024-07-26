@extends('template.template')
@section('title','Approve Data')
@section('content')
    <h4 id="textheader" class="text-center"><i class="fa-solid fa-check-to-slot fa-lg mx-4"></i>ส่วนอนุมัติข้อมูล Linecall</h4>
    @php
        $displayedRecords = [];
        $leakdocById = [];

        // Prepare leakdoc data by LNCL_HREC_ID
        foreach($leakdoc as $doc) {
            $leakdocById[$doc->LNCL_HREC_ID][] = $doc;
        }
    @endphp

    @foreach($documents as $get)
        @php
            $lnclHrecId = $get->LNCL_HREC_ID; // Get the current document's LNCL_HREC_ID
        @endphp

        @if(!in_array($lnclHrecId, $displayedRecords))
            <div class="card mt-3" style="background: #fff">

                <div class="card-body p-3">
                    <p style="font-weight: 700; font-size: 22px; background: #003049; color: #fdfffc; border-radius: 10px;" class="p-2 text-center">ข้อมูลการบันทึกแบบฟอร์มหลัก</p>

                    <div class="row">
                        <div class="col" style="background: #bcb8b1; color: #003566; border-radius: 10px 0 0 10px;">
                            <p style="font-weight: 700; font-size: 22px" class="mt-2">Employee ID: {{ $get->LNCL_HREC_EMPID }}</p>
                            <p style="font-weight: 700; font-size: 22px">LINE: {{ $get->LNCL_HREC_LINE }}</p>
                            <p style="font-weight: 700; font-size: 22px">Customer: {{ $get->LNCL_HREC_CUS }}</p>
                            <p style="font-weight: 700; font-size: 22px">Qty: {{ $get->LNCL_HREC_QTY }}</p>
                            <p style="font-weight: 700; font-size: 22px">Defict: {{ $get->LNCL_HREC_DEFICT }}</p>
                            <p style="font-weight: 700; font-size: 22px">Percent: {{ $get->LNCL_HREC_PERCENT }}</p>
                        </div>
                        <div class="col" style="background: #bcb8b1; color: #003566;">
                            <p style="font-weight: 700; font-size: 22px" class="mt-2">Work Order: {{ $get->LNCL_HREC_WON }}</p>
                            <p style="font-weight: 700; font-size: 22px">Model Name: {{ $get->LNCL_HREC_MDLNM }}</p>
                            <p style="font-weight: 700; font-size: 22px">Model Code: {{ $get->LNCL_HREC_MDLCD }}</p>
                            <p style="font-weight: 700; font-size: 22px">NG Code: {{ $get->LNCL_HREC_NGCD }}</p>
                            <p style="font-weight: 700; font-size: 22px">NG Process: {{ $get->LNCL_HREC_NGPRCS }}</p>
                        </div>
                        <div class="col" style="background: #bcb8b1; color: #003566; border-radius: 0 10px 10px 0;">
                            <p style="font-weight: 700; font-size: 22px" class="mt-2">NG Position: {{ $get->LNCL_HREC_NGPST }}</p>
                            <p style="font-weight: 700; font-size: 22px">Serial: {{ $get->LNCL_HREC_SERIAL }}</p>
                            <p style="font-weight: 700; font-size: 22px">Ref. document: {{ $get->LNCL_HREC_REFDOC }}</p>
                        </div>
                    </div>

                    <hr style="color: darkblue; padding: 2px;">
                    <div class="row" style="background: #aed9e0; border-radius: 10px 10px 0 0; color: #ff0054;">
                        <div class="col">
                            <p style="font-weight: 700; font-size: 22px" class="mt-2">Problem<i class="bi bi-caret-down-fill ms-2"></i></p>
                            <textarea class="form-control" rows="5" style="font-size: 22px; font-weight: bold; color: #ff0054;">{{$get->LNCL_HREC_PROBLEM}}</textarea>

                        </div>
                        <div class="col">
                            <ul>
                                @foreach($images[$lnclHrecId] ?? [] as $image)
                                    <img src="{{ asset('public/images/'.$image->LNCL_IMAGES_FILES) }}" class="mt-1" width="300px" onclick="ViewImage('{{ $image->LNCL_IMAGES_FILES }}')"><br>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row p-2" style="background: #aed9e0; color: #ff0054;">
                        <div class="col">
                            <p style="font-weight: 700; font-size: 22px">Cause<i class="bi bi-caret-down-fill ms-2"></i></p>
                            <textarea class="form-control" rows="5" style="font-size: 22px; font-weight: bold; color: #ff0054;">{{$get->LNCL_HREC_CAUSE}}</textarea>
                        </div>
                        <div class="col">
                            <p style="font-weight: 700; font-size: 22px">Temporary Action<i class="bi bi-caret-down-fill ms-2"></i></p>
                            <textarea class="form-control" rows="5" style="font-size: 22px; font-weight: bold; color: #ff0054;">{{$get->LNCL_HREC_ACTION}}</textarea>
                        </div>
                    </div>

                    <hr style="color: darkblue; padding: 5px;">
                    <p style="font-weight: 700; font-size: 22px; background: #faedcd; color: #f77f00; border-radius: 10px;" class="p-2 text-center">ข้อมูลการบันทึกแบบฟอร์ม LEAK AND ROOT (5 WHY)</p>
                    @if(isset($leakdocById[$lnclHrecId]))
                        @foreach($leakdocById[$lnclHrecId] as $doc)
                            <div class="row" style="background: #a2d2ff;">
                                <div class="col mt-3">
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">Section: <span style="font-size: 22px; font-weight: bold; color: #f77f00;">{{$doc->LNCL_LEAKANDROOT_SECTION}}</span></p>
                                </div>
                                <div class="col mt-3">
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">Employee ID: <span style="font-size: 22px; font-weight: bold; color: #f77f00;">{{$doc->LNCL_LEAKANDROOT_EMPID}}</span></p>
                                </div>
                                <div class="col mt-3">
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">Name: <span style="font-size: 22px; font-weight: bold; color: #f77f00;">{{$doc->LNCL_LEAKANDROOT_NAME}}</span></p>
                                </div>
                            </div>
                            <div class="row" style="background: #a2d2ff;">

                                <hr style="color: darkblue; padding: 5px;">
                                <div class="col">
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">LEAK WHY 1<i class="bi bi-caret-down-fill ms-2"></i></p>
                                    <textarea class="form-control" rows="3" style="font-size: 22px; font-weight: bold; color: #14213d;">{{$doc->LNCL_LEAK_WHY1}}</textarea>
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">LEAK WHY 2<i class="bi bi-caret-down-fill ms-2"></i></p>
                                    <textarea class="form-control" rows="3" style="font-size: 22px; font-weight: bold; color: #14213d;">{{$doc->LNCL_LEAK_WHY2}}</textarea>
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">LEAK WHY 3<i class="bi bi-caret-down-fill ms-2"></i></p>
                                    <textarea class="form-control" rows="3" style="font-size: 22px; font-weight: bold; color: #14213d;">{{$doc->LNCL_LEAK_WHY3}}</textarea>
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">LEAK WHY 4<i class="bi bi-caret-down-fill ms-2"></i></p>
                                    <textarea class="form-control" rows="3" style="font-size: 22px; font-weight: bold; color: #14213d;">{{$doc->LNCL_LEAK_WHY4}}</textarea>
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">LEAK WHY 5<i class="bi bi-caret-down-fill ms-2"></i></p>
                                    <textarea class="form-control" rows="3" style="font-size: 22px; font-weight: bold; color: #14213d;">{{$doc->LNCL_LEAK_WHY5}}</textarea>
                                </div>
                                <div class="col">
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">Images Leak 5 WHY<i class="bi bi-caret-down-fill ms-2"></i></p>

                                    @foreach($imagesleak[$lnclHrecId] as $imgl)
                                        <img src="{{asset('public/images/'.$imgl->LNCL_IMAGES_FILES)}}" class="mt-1" width="300px" onclick="ViewImage2('{{$imgl->LNCL_IMAGES_FILES}}')"><br>
                                    @endforeach

                                </div>

                            </div>
                            <div class="row" style="background: #a2d2ff;">
                                <div class="col  mb-3">
                                    <p style="font-size: 22px; font-weight: bold; color: #14213d;">LEAK ACTION<i class="bi bi-caret-down-fill ms-2"></i></p>
                                    <textarea class="form-control" rows="3" style="font-size: 22px; font-weight: bold; color: #14213d;">{{$doc->LNCL_LEAK_ACTION}}</textarea>

                                </div>

                            </div>
                        @endforeach
                    @endif

                    <hr style="color: darkblue; padding: 5px;">

                    <div class="d-flex justify-content-start">
                        <button class="btn btnsuccess"><i class="fa-solid fa-square-check fa-lg mx-1"></i>อนุมัติ</button>
                        <button class="btn btnreject ms-3"><i class="fa-solid fa-user-pen fa-lg mx-1"></i>ส่งกลับแก้ไข</button>
                    </div>
                </div>
            </div>

            @php
                $displayedRecords[] = $lnclHrecId;
            @endphp
        @endif
    @endforeach






@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function () {
            $('#li-approve').addClass('active');

        })

        function ViewImage(images){

            // Create overlay
            var overlay = document.createElement('div');
            overlay.className = 'overlay';
            overlay.onclick = function() {
                document.body.removeChild(overlay);
                document.body.removeChild(zoomedImage);
            };
            // Create zoomed image
            var zoomedImage = document.createElement('img');
            zoomedImage.src = "{{ asset('public/images/') }}" + "/" + images;
            zoomedImage.className = 'zoomed';
            // Append to body
            document.body.appendChild(overlay);
            document.body.appendChild(zoomedImage);

        }

        function ViewImage2(images2){

            // Create overlay
            var overlay = document.createElement('div');
            overlay.className = 'overlay';
            overlay.onclick = function() {
                document.body.removeChild(overlay);
                document.body.removeChild(zoomedImage);
            };
            // Create zoomed image
            var zoomedImage = document.createElement('img');
            zoomedImage.src = "{{ asset('public/images/') }}" + "/" + images2;
            zoomedImage.className = 'zoomed';
            // Append to body
            document.body.appendChild(overlay);
            document.body.appendChild(zoomedImage);

        }


        // var table = $('#test').DataTable({
        //     initComplete: function () {
        //         let headerRow = $("#test thead tr")
        //             .clone(true)
        //             .appendTo("#test thead");
        //
        //         headerRow.find("th").each(function (i) {
        //             let title = $(this).text();
        //
        //             // Create input element
        //             let input = document.createElement('input');
        //             input.placeholder = 'Search ' + title;
        //             $(this).html(input);
        //
        //             // Apply the search
        //             $('input', this).on('keyup change', function () {
        //                 if (table.column(i).search() !== this.value) {
        //                     table
        //                         .column(i)
        //                         .search(this.value)
        //                         .draw();
        //                 }
        //             });
        //         });
        //     },
        //     info: false,
        //     paging: false,
        //     layout: {
        //         topStart: {
        //             buttons: [{
        //                 extend: 'copyHtml5',
        //                 text: 'Copy',
        //                 className: 'btn-success',
        //                 exportOptions: {
        //                     charset: 'UTF-8',
        //                     bom: true // Byte Order Mark for UTF-8
        //                 }
        //             },
        //                 {
        //                 extend: 'excelHtml5',
        //                 text: 'Excel',
        //                 className: 'btn-success',
        //                 title: 'รายงานขอใช้รถประจำวันที่ ',
        //                 exportOptions: {
        //                     charset: 'UTF-8',
        //                     bom: true // Byte Order Mark for UTF-8
        //                 }
        //             }]
        //
        //         }
        //     }
        // })

    </script>
@endpush
