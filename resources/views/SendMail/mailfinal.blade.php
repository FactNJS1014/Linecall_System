@component('mail::message')
    <h1 style="text-align: center; color: #023e8a;">Linecall System</h1>
    <p style="font-size: 18px; color: black; font-weight: 500; text-align: center;">เข้าไปตรวจสอบและอนุมัติข้อมูล Linecall
    </p>
    @component('mail::button', ['url' => $link])
        Check Data
    @endcomponent
@endcomponent
