<x-app>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>
    <style>
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 32px 24px;
        }
        h2 {
            color: #1abc9c;
            font-weight: bold;
            margin-bottom: 24px;
        }
        .table {
            width: 100%;
            background: #fafbfc;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #eaeaea;
        }
        .table th {
            background: #f5f5f5;
            color: #333;
            font-weight: 600;
        }
        .table tr:last-child td {
            border-bottom: none;
        }
        .text-success {
            color: #27ae60;
            font-weight: bold;
        }
        .text-danger {
            color: #e74c3c;
            font-weight: bold;
        }
        .btn-cancel {
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 14px;
            cursor: pointer;
            font-weight: 500;
            margin-left: 8px;
        }
        .btn-cancel:hover {
            background: #c0392b;
        }
    </style>
    <div class="container mt-4">
        <h2>Lịch sử đặt sân</h2>
        @if(session('success'))
            <div style="color: #27ae60; margin-bottom: 12px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="color: #e74c3c; margin-bottom: 12px;">{{ session('error') }}</div>
        @endif

        {{-- Form lọc trạng thái --}}
        <form method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center;">
            <label for="status" style="font-weight: 500;">Lọc trạng thái:</label>
            <select name="status" id="status" onchange="this.form.submit()" style="padding: 6px 12px; border-radius: 4px;">
                <option value="">Tất cả</option>
                <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
            </select>
        </form>

        @if($history->isEmpty())
            <p>Bạn chưa có lịch sử đặt sân nào.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sân</th>
                        <th>Ngày</th>
                        <th>Giờ</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $item)
                    <tr>
                        <td>{{ $item->field->name ?? 'Không rõ' }}</td>
                        <td>{{ $item->booking_date ?? '' }}</td>
                        <td>{{ $item->start_time . ' - ' . $item->end_time }}</td>
                        <td>
                            @if($item->status === 'paid')
                                <span class="text-success">Đã thanh toán</span>
                            @elseif($item->status === 'canceled')
                                <span style="color: #888; font-weight: bold;">Đã hủy</span>
                            @else
                                <span class="text-danger">Chưa thanh toán</span>
                                {{-- Nút Thanh toán --}}
                                <a href="{{ route('payment', $item->id) }}" class="btn btn-success" style="margin-left:8px;">Thanh toán</a>
                                {{-- Đếm ngược --}}
                                <span class="countdown" 
                                      data-created="{{ \Carbon\Carbon::parse($item->created_at)->timestamp }}" 
                                      data-id="{{ $item->id }}"
                                      style="margin-left:8px; color:#2980b9; font-weight:bold;">
                                    15:00
                                </span>
                                <form action="{{ route('bookings.destroy', $item->id) }}" method="POST" style="display:inline;" class="form-cancel">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-cancel" onclick="return confirm('Bạn chắc chắn muốn hủy đặt sân này?')">Hủy</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top:16px; color:#555; font-size:15px;">
                <div>
                    <span style="color:#e74c3c; font-weight:bold;">Chú ý:</span> 
                    Bạn chỉ có thể hủy sân khi <span style="color:#e74c3c;">chưa thanh toán</span>. 
                    Nếu sân đã thanh toán, vui lòng liên hệ tổng đài <b>0123 456 789</b> để được hỗ trợ.
                </div>
            </div>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.countdown').forEach(function (el) {
                const created = parseInt(el.dataset.created) * 1000;
                const expire = created + 15 * 60 * 1000; // 15 phút
                const form = el.closest('td').querySelector('.form-cancel');
                function update() {
                    const now = Date.now();
                    let remain = Math.floor((expire - now) / 1000);
                    if (remain <= 0) {
                        el.innerText = 'Đã hết hạn';
                        el.closest('tr').style.opacity = 0.5;
                        if (form) form.style.display = 'none'; // Ẩn nút hủy
                        return;
                    }
                    const m = String(Math.floor(remain / 60)).padStart(2, '0');
                    const s = String(remain % 60).padStart(2, '0');
                    el.innerText = m + ':' + s;
                    setTimeout(update, 1000);
                }
                update();
            });
        });
    </script>
</x-app>