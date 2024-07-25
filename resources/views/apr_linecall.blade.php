@extends('template.template')
@section('title','Approve Data')
@section('content')
    <h4 id="textheader" class="text-center"><i class="fa-solid fa-check-to-slot fa-lg mx-4"></i>ส่วนอนุมัติข้อมูล Linecall</h4>

            @foreach($images as $lnclHrecId => $imageGroup)
                <div class="card">
                <h3>Record ID: {{ $lnclHrecId }}</h3>

                <h4>Images:</h4>
                <ul>
                    @foreach($imageGroup as $image)
                        <img src="{{asset('public/images/'.$image->LNCL_IMAGES_FILES)}}" width="300px" onclick="ViewImage('{{$image->LNCL_IMAGES_FILES}}')"><br>
                    @endforeach
                </ul>

                @foreach($documents as $crud => $docshow)
                    @foreach($docshow as $show )
                        <p>{{$show->LNCL_HREC_EMPID}}</p>
                    @endforeach
                @endforeach
                </div>
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
