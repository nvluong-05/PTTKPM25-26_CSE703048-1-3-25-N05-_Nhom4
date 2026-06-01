@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <h1 class="mb-4">Bảng điều khiển</h1>
    <div class="alert alert-success">Chào mừng bạn đến trang quản trị!</div>

    {{-- CARDS THỐNG KÊ --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Tổng người dùng</h5>
                    <p class="card-text fs-3">{{ $userCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Tổng sân bóng</h5>
                    <p class="card-text fs-3">{{ $fieldCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning shadow">
                <div class="card-body">
                    <h5 class="card-title">Tổng lượt đặt sân</h5>
                    <p class="card-text fs-3">{{ $bookingCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger shadow">
                <div class="card-body">
                    <h5 class="card-title">Tổng doanh thu</h5>
                    <p class="card-text fs-4">{{ number_format($totalRevenue ?? 0) }} đ</p>
                </div>
            </div>
        </div>
    </div>

    {{-- BIỂU ĐỒ DOANH THU --}}
    <div class="row g-4">
        {{-- Biểu đồ doanh thu theo sân --}}
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white fw-bold">
                    📊 Doanh thu theo từng sân
                </div>
                <div class="card-body">
                    <canvas id="chartByField" height="300"></canvas>
                </div>
            </div>
        </div>

        {{-- Biểu đồ doanh thu theo tháng --}}
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white fw-bold">
                    📈 Doanh thu theo tháng ({{ now()->year }})
                </div>
                <div class="card-body">
                    <canvas id="chartByMonth" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- BẢNG DOANH THU THEO SÂN --}}
    <div class="card shadow mt-4">
        <div class="card-header bg-dark text-white fw-bold">
            🏟️ Chi tiết doanh thu theo sân
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên sân</th>
                        <th class="text-end">Doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($revenueByField as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td class="text-end text-success fw-bold">
                                {{ number_format($item['revenue']) }} đ
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                Chưa có doanh thu nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <th colspan="2">Tổng cộng</th>
                        <th class="text-end text-danger">
                            {{ number_format($totalRevenue ?? 0) }} đ
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Dữ liệu từ Laravel
    const fieldLabels  = @json($revenueByField->pluck('name'));
    const fieldData    = @json($revenueByField->pluck('revenue'));
    const monthLabels  = @json($revenueByMonth->pluck('month'));
    const monthData    = @json($revenueByMonth->pluck('revenue'));

    // Màu ngẫu nhiên cho từng sân
    const colors = fieldLabels.map((_, i) =>
        `hsl(${(i * 60) % 360}, 70%, 55%)`
    );

    // Biểu đồ doanh thu theo sân (Bar chart)
    new Chart(document.getElementById('chartByField'), {
        type: 'bar',
        data: {
            labels: fieldLabels,
            datasets: [{
                label: 'Doanh thu (đ)',
                data: fieldData,
                backgroundColor: colors,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => new Intl.NumberFormat('vi-VN').format(ctx.raw) + ' đ'
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: val => new Intl.NumberFormat('vi-VN').format(val) + ' đ'
                    }
                }
            }
        }
    });

    // Biểu đồ doanh thu theo tháng (Line chart)
    new Chart(document.getElementById('chartByMonth'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Doanh thu (đ)',
                data: monthData,
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.15)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => new Intl.NumberFormat('vi-VN').format(ctx.raw) + ' đ'
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: val => new Intl.NumberFormat('vi-VN').format(val) + ' đ'
                    }
                }
            }
        }
    });
</script>
@endpush