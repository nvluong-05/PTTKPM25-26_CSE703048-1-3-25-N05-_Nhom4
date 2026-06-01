<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/contact-info.css') }}">

    @if(session('success'))
        <script>
            // Hiển thị toast hoặc alert
            document.addEventListener('DOMContentLoaded', function() {
                // Ví dụ dùng alert
                alert("{{ session('success') }}");
                // Hoặc custom toast ở đây
            });
        </script>
    @endif

    @php
        // Demo dữ liệu liên hệ (thay bằng dữ liệu từ controller khi dùng thực tế)
        $contacts = [
            ['name' => 'Lee Hồnn Foot', 'email' => 'doibuonjqk@gmail.com', 'phone' => '123456789', 'position' => 'Trưởng dự án'],
            ['name' => 'Nguyễn Văn A', 'email' => 'nguyenvana@gmail.com', 'phone' => '0987654321', 'position' => 'Thành viên'],
            ['name' => 'Trần Thị B', 'email' => 'tranthib@gmail.com', 'phone' => '0911222333', 'position' => 'Thành viên'],
            ['name' => 'Phạm Văn C', 'email' => 'phamvanc@gmail.com', 'phone' => '0909090909', 'position' => 'Thành viên'],
        ];
        $search = request('search');
        if ($search) {
            $contacts = array_filter($contacts, function($c) use ($search) {
                return stripos($c['name'], $search) !== false
                    || stripos($c['email'], $search) !== false
                    || stripos($c['phone'], $search) !== false
                    || stripos($c['position'], $search) !== false;
            });
        }
    @endphp

    <div class="contact-reason">
        <img src="{{ asset('img/vietnam-flag.png') }}" alt="Thắc mắc" class="faq-img">
        <strong>Lý do liên hệ:</strong>
        <ul>
            <li>Hỗ trợ kỹ thuật hoặc thắc mắc về hệ thống.</li>
            <li>Liên hệ hợp tác, quảng cáo hoặc tài trợ.</li>
            <li>Góp ý, phản hồi về nội dung hoặc chức năng.</li>
        </ul>
    </div>

    <!-- <div class="search-box">
        <form method="GET">
            <input type="text" name="search" placeholder="Tìm kiếm liên hệ..." value="{{ request('search') }}">
            <button type="submit">Tìm kiếm</button>
        </form>
    </div> -->

    <table class="contact-table">
        <thead>
            <tr>
                <th>Họ tên</th>
                <th>Chức vụ</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Liên hệ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
            <tr>
                <td>{{ $contact['name'] }}</td>
                <td>{{ $contact['position'] }}</td>
                <td>{{ $contact['email'] }}</td>
                <td>{{ $contact['phone'] }}</td>
                <td>
                    <button type="button" class="btn open-email-modal" data-email="{{ $contact['email'] }}">Email</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;">Không tìm thấy liên hệ nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal gửi email -->
    <div id="emailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full relative p-6">
            <button id="closeEmailModalBtn" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-4">Gửi email</h2>
            <form id="sendEmailForm" method="POST" action="{{ route('infor.sendEmail') }}">
                @csrf
                <div class="mb-3">
                    <label class="block mb-1">Đến:</label>
                    <input type="email" id="emailTo" name="to" class="w-full border rounded px-2 py-1" readonly>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Tiêu đề:</label>
                    <input type="text" name="subject" class="w-full border rounded px-2 py-1" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Nội dung:</label>
                    <textarea name="body" class="w-full border rounded px-2 py-1" rows="4" required></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Gửi</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/email-modal.js') }}"></script>
</x-app-layout>
