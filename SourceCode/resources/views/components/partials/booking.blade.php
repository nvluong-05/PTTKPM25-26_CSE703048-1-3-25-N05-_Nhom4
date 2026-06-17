<x-app-layout>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert("{{ session('success') }}");
            });
        </script>
    @endif
    <script>
        window.fieldsData = @json($fields);
        window.bookedTimes = @json($bookedTimes);
        window.isGuest = {{ Auth::guest() ? 'true' : 'false' }};
        window.bookingHasError = {{ $errors->has('booking_time') ? 'true' : 'false' }};
    </script>
    <script src="{{ asset('js/booking-modal.js') }}"></script>
    <script src="{{ asset('js/booking-script.js') }}"></script>
    <main class="py-10 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- DANH SÁCH SÂN BÓNG NỔI BẬT -->
            <div class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Sân bóng nổi bật</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($fields as $field)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden" data-field-id="{{ $field->id }}">
                            <div class="relative">
                                <img
                                    src="{{ $field->image ?? 'https://via.placeholder.com/400x250?text=No+Image' }}"
                                    alt="{{ $field->name }}"
                                    class="w-full h-48 object-cover object-top" />
                                @if($field->active)
                                    <div class="absolute top-2 left-2 bg-green-600 text-white text-sm px-2 py-1 rounded">
                                        Đang hoạt động
                                    </div>
                                @else
                                    <div class="absolute top-2 left-2 bg-gray-400 text-white text-sm px-2 py-1 rounded">
                                        Tạm dừng
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-1">{{ $field->name }}</h3>
                                <div class="text-sm text-gray-600 mb-2">{{ $field->address }}</div>
                                <div class="text-sm text-gray-600 mb-2">Loại sân: {{ $field->type ?? 'Chưa rõ' }}</div>
                                <div class="text-sm text-gray-600 mb-2">{{ $field->description }}</div>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm text-gray-600">Giá/giờ:</span>
                                    <span class="font-semibold text-primary">{{ number_format($field->price_per_hour) }} đ</span>
                                </div>
                                @guest
                                    <button class="w-full bg-primary text-white py-2 rounded dat-san-btn">
                                        Đặt sân
                                    </button>
                                @else
                                    <button class="w-full bg-primary text-white py-2 rounded dat-san-btn">
                                        Đặt sân
                                    </button>
                                @endguest
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- MODAL ĐẶT SÂN (Alpine.js) -->
            <div id="booking-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 hidden">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-auto">
                    <div class="p-6">
                        @if($errors->has('booking_time'))
                            <div class="text-red-600 mb-2">{{ $errors->first('booking_time') }}</div>
                        @endif
                        <div
                            x-data="{
                                pricePerHour: 0,
                                totalPrice: 0,
                                selectedFieldId: '',
                                bookingDate: '',
                                slots: (function() {
                                    let result = [];
                                    let start = 6 * 60;
                                    let end = 22 * 60;
                                    while (start + 60 <= end) {
                                        let slotStart = start;
                                        let slotEnd = start + 60;
                                        result.push({
                                            start: slotStart,
                                            end: slotEnd
                                        });
                                        start += 75;
                                    }
                                    return result;
                                })(),
                                selectedSlot: null,
                                bookedTimes: window.bookedTimes ?? {},
                                formatTime(minute) {
                                    const h = Math.floor(minute/60);
                                    const m = minute%60;
                                    return (h<10?'0':'')+h+':'+(m<10?'0':'')+m;
                                },
                                isBooked(slot) {
                                    if (!this.selectedFieldId || !this.bookingDate) return false;
                                    const bookings = this.bookedTimes[this.selectedFieldId]?.[this.bookingDate] ?? [];
                                    return bookings.some(b => {
                                        const start = parseInt(b.start.split(':')[0])*60 + parseInt(b.start.split(':')[1]);
                                        const end = parseInt(b.end.split(':')[0])*60 + parseInt(b.end.split(':')[1]);
                                        return slot.start < end && slot.end > start;
                                    });
                                },
                                calcTotal() {
                                    this.totalPrice = (this.selectedSlot !== null && this.pricePerHour) ? this.pricePerHour : 0;
                                }
                            }"
                        >
                            @auth
                            <form method="POST" action="{{ route('bookings.store') }}">
                                @csrf
                                <input type="hidden" name="field_id" :value="selectedFieldId">
                                <div class="mb-4">
                                    <label>Chọn sân</label>
                                    <select name="field_id"
                                        class="w-full border rounded p-2"
                                        x-on:change="
                                            pricePerHour = $event.target.selectedOptions[0].dataset.price;
                                            selectedFieldId = $event.target.value;
                                            selectedSlot = null;
                                            calcTotal();
                                        "
                                        required>
                                        <option value="">-- Chọn sân --</option>
                                        @foreach($fields as $field)
                                            <option value="{{ $field->id }}" data-price="{{ $field->price_per_hour }}">
                                                {{ $field->name }} - {{ $field->address }} ({{ number_format($field->price_per_hour) }}đ/giờ)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label>Ngày đặt sân</label>
                                    <input type="date" name="booking_date" class="w-full border rounded p-2"
                                        x-model="bookingDate"
                                        min="{{ date('Y-m-d') }}"
                                        @change="selectedSlot = null; calcTotal();" required>
                                </div>
                                <!-- Khung giờ đặt sân -->
                                <div class="mb-4">
                                    <label>Chọn khung giờ</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <template x-for="(slot, idx) in slots" :key="idx">
                                            <button
                                                type="button"
                                                class="border rounded p-2 w-full"
                                                :class="isBooked(slot) ? 'bg-red-200 cursor-not-allowed' : (selectedSlot === idx ? 'bg-blue-500 text-white' : 'bg-white')"
                                                :disabled="isBooked(slot)"
                                                @click="selectedSlot = idx; calcTotal();"
                                                x-text="formatTime(slot.start) + ' - ' + formatTime(slot.end)"
                                            ></button>
                                        </template>
                                    </div>
                                    <input type="hidden" name="start_time" :value="selectedSlot !== null ? formatTime(slots[selectedSlot].start) : ''">
                                    <input type="hidden" name="end_time" :value="selectedSlot !== null ? formatTime(slots[selectedSlot].end) : ''">
                                </div>
                                <div class="mb-4">
                                    <label>Tổng tiền (VNĐ)</label>
                                    <input type="number" name="total_price" class="w-full border rounded p-2 bg-gray-100"
                                        :value="totalPrice" readonly required>
                                </div>
                                <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Xác nhận đặt sân</button>
                            </form>
                            @else
                                <div class="text-center text-red-600 font-semibold py-8">
                                    Bạn cần <a href="{{ route('login') }}" class="underline text-blue-600">đăng nhập</a> để đặt sân!
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        flatpickr("input[name='booking_date']", {
            minDate: "{{ date('Y-m-d') }}",
            dateFormat: "Y-m-d"
        });
    </script>
</x-app-layout>
