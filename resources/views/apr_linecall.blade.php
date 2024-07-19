@extends('template.template')
@section('title','Approve Data')
@section('content')
    <h4 id="textheader" class="text-center"><i class='bx bxs-message-check h3 mx-3'></i>ส่วนอนุมัติข้อมูล Linecall</h4>
    <div class="card mt-2">
        <div class="p-2">
            <table class="table table-bordered" id="test">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Adele</td>
                    <td>25</td>
                </tr>
                <tr>
                    <td>Mario</td>
                    <td>26</td>
                </tr>
                <tr>
                    <td>Merry</td>
                    <td>25</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function () {
            $('#li-approve').addClass('active');

        })

        var table = $('#test').DataTable({
            initComplete: function () {
                let headerRow = $("#test thead tr")
                    .clone(true)
                    .appendTo("#test thead");

                headerRow.find("th").each(function (i) {
                    let title = $(this).text();

                    // Create input element
                    let input = document.createElement('input');
                    input.placeholder = 'Search ' + title;
                    $(this).html(input);

                    // Apply the search
                    $('input', this).on('keyup change', function () {
                        if (table.column(i).search() !== this.value) {
                            table
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            },
            info: false,
            paging: false,
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'copyHtml5',
                        text: 'Copy',
                        className: 'btn-success',
                        exportOptions: {
                            charset: 'UTF-8',
                            bom: true // Byte Order Mark for UTF-8
                        }
                    },
                        {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'btn-success',
                        title: 'รายงานขอใช้รถประจำวันที่ ',
                        exportOptions: {
                            charset: 'UTF-8',
                            bom: true // Byte Order Mark for UTF-8
                        }
                    }]

                }
            }
        })

    </script>
@endpush
