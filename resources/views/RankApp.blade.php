@extends('template.template')
@section('title','Master Rank')

@section('content')
    <h3 class="text-center" id="textheader"><i class="bi bi-person-fill-add fs-4 mx-2"></i>สร้างผู้อนุมัติตามลำดับในแผนก</h3>

    <div class="card mt-2">
        <div class="d-flex" id="form-content">
            <form action="">
                <div class="card-body">

                    <label for="" class="h5" style="color: #003f88;">Section:</label>
                    <select name="section_master" id="section_master" class="form-select form-control">
                        <option value="" selected disabled>Choose Section</option>
                        <option value="MT">MT</option>
                        <option value="AM">AM</option>

                    </select>


                    <label for="" class="h5 mt-2" style="color: #003f88;">Approve Level 1:</label>
                    <select name="lv1_app" id="lv1_app" class="form-select form-control p-2 ">
                        <option value="" selected disabled>เลือกผู้อนุมัติในลำดับที่ 1</option>
                        <option value="MT">person 1</option>
                        <option value="AM">person 2</option>

                    </select>


                    <label for="" class="h5 mt-2" style="color: #003f88;">Approve Level 2:</label>
                    <input type="text" name="emp_last" id="emp_last" class="form-control p-2 " placeholder="ผู้อนุมัติลำดับที่ 2">

                    <input type="submit" value="สร้างผู้อนุมัติ" class="btn masterbtn mt-3">

                </div>
            </form>
        </div>


    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4>ข้อมูลลำดับการอนุมัติตามแผนก</h4>
        </div>
    </div>
@endsection

@push('script_content')
    <script !src="">
        $(document).ready(function () {
            $('#li-rank').addClass('active');
        })
    </script>
@endpush
