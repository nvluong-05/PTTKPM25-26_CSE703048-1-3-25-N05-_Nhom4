<x-app-layout>
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center text-green-600">Thanh toán đặt sân</h2>
    <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-2 rounded text-center mb-4">
        Vui lòng hoàn tất thanh toán trong <span id="countdown" class="font-bold text-red-600">15:00</span> phút, nếu không sân sẽ bị hủy!
    </div>
    <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-2 rounded mb-4">
        <div><b>Sân:</b> {{ $booking->field->name ?? '' }}</div>
        <div><b>Ngày:</b> {{ $booking->booking_date }}</div>
        <div><b>Giờ:</b> {{ $booking->start_time }} - {{ $booking->end_time }}</div>
        <div><b>Tổng tiền:</b> {{ number_format($booking->total_price) }} đ</div>
    </div>
    <form>
        <div class="mb-4">
            <label class="block font-semibold mb-2">Chọn hình thức thanh toán:</label>
            <div class="flex items-center space-x-6">
                <label class="inline-flex items-center">
                    <input class="form-radio text-green-600" type="radio" name="payment_method" id="bank" checked>
                    <span class="ml-2">Chuyển khoản ngân hàng</span>
                </label>
                <label class="inline-flex items-center">
                    <input class="form-radio text-green-600" type="radio" name="payment_method" id="qr">
                    <span class="ml-2">Quét mã QR (QR Pay)</span>
                </label>
            </div>
        </div>
        <div id="bank-info" class="mb-4">
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-2 rounded">
                <div><b>Ngân hàng:</b> Vietcombank</div>
                <div><b>Số tài khoản:</b> 0123456789</div>
                <div><b>Tên chủ TK:</b> NGUYEN VAN A</div>
                <div><b>Nội dung chuyển khoản:</b> THANHTOAN-{{ auth()->user()->id ?? 'USER' }}-{{ now()->format('His') }}</div>
            </div>
        </div>
        <div id="qr-info" class="mb-4 hidden">
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-2 rounded text-center">
                <div>Quét mã QR bằng app ngân hàng:</div>
                <img src="{{ asset('images/qr-demo.png') }}" alt="QR Pay" class="mx-auto my-2" style="max-width:200px;">
                <div class="mt-2"><b>Nội dung:</b> THANHTOAN-{{ auth()->user()->id ?? 'USER' }}-{{ now()->format('His') }}</div>
            </div>
        </div>
        <button type="button" id="btn-paid" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition">Tôi đã thanh toán</button>
        <div id="success-msg" class="hidden mt-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded text-center font-semibold">
            Thanh toán thành công!
        </div>
    </form>
</div>

<script>
    // Đếm ngược 15 phút
    let time = 15 * 60;
    const countdown = document.getElementById('countdown');
    let timer = setInterval(function() {
        let minutes = Math.floor(time / 60);
        let seconds = time % 60;
        countdown.textContent = `${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
        if (time <= 0) {
            clearInterval(timer);
            alert('Hết thời gian thanh toán! Sân của bạn đã bị hủy.');
            window.location.href = "{{ route('main') }}";
        }
        time--;
    }, 1000);

    // Chọn hình thức thanh toán
    document.getElementById('bank').addEventListener('change', function() {
        document.getElementById('bank-info').classList.remove('hidden');
        document.getElementById('qr-info').classList.add('hidden');
    });
    document.getElementById('qr').addEventListener('change', function() {
        document.getElementById('bank-info').classList.add('hidden');
        document.getElementById('qr-info').classList.remove('hidden');
    });

    // Xử lý nút đã thanh toán
    document.getElementById('btn-paid').addEventListener('click', function() {
        fetch("{{ route('payment.success', ['booking' => $booking->id]) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('success-msg').classList.remove('hidden');
                document.getElementById('btn-paid').style.display = 'none';
                clearInterval(timer); // Ngưng đếm ngược
                // Ẩn dòng đếm giờ
                document.getElementById('countdown').parentElement.style.display = 'none';
                // Hiện nút về trang chủ
                let homeBtn = document.createElement('a');
                homeBtn.href = "{{ route('main') }}";
                homeBtn.className = "w-full block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded text-center transition mt-4";
                homeBtn.innerText = "Về trang chủ";
                document.querySelector('.max-w-xl form').appendChild(homeBtn);
            }
        });
    });
</script>
</x-app-layout>