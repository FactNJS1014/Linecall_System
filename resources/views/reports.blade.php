@extends('template.template')
@section('title','Reports')
@section('content')
    <h4 id="textheader" class="text-center"><i class="fa-solid fa-chart-pie fa-lg mx-3"></i>รายงานข้อมูล Linecall System</h4>
@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function () {
            $('#li-reports').addClass('active');
        })
    </script>
@endpush
