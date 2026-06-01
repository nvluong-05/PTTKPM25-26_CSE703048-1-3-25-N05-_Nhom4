<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg p-8 max-w-md w-full relative">
      <button class="close-modal absolute top-4 right-4 text-gray-400 hover:text-gray-600">
        <i class="ri-close-line text-2xl"></i>
      </button>
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Đăng nhập</h2>
      <form class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-1 focus:ring-primary">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
          <input type="password" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-1 focus:ring-primary">
        </div>
        <div class="flex justify-between">
          <label class="flex items-center text-sm text-gray-600">
            <input type="checkbox" class="custom-checkbox mr-2"> Ghi nhớ đăng nhập
          </label>
          <a href="#" class="text-sm text-primary">Quên mật khẩu?</a>
        </div>
        <button type="submit" class="w-full bg-primary text-white py-2 rounded-button font-medium">Đăng nhập</button>
      </form>
      <div class="mt-4 text-center text-sm">
        Chưa có tài khoản? <button id="switchToRegister" class="text-primary">Đăng ký</button>
      </div>
    </div>
  </div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg p-8 max-w-md w-full relative">
      <button class="close-modal absolute top-4 right-4 text-gray-400 hover:text-gray-600">
        <i class="ri-close-line text-2xl"></i>
      </button>
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Đăng ký</h2>
      <form class="space-y-4">
        <input type="text" placeholder="Họ và tên" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-1 focus:ring-primary">
        <input type="email" placeholder="Email" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-1 focus:ring-primary">
        <input type="tel" placeholder="Số điện thoại" class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-1 focus:ring-primary">
        <input type="password" placeholder="Mật khẩu" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-1 focus:ring-primary">
        <input type="password" placeholder="Xác nhận mật khẩu" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-1 focus:ring-primary">
        <label class="flex items-start text-sm text-gray-600">
          <input type="checkbox" class="custom-checkbox mt-1 mr-2" required>
          Tôi đồng ý với <a href="#" class="text-primary ml-1">Điều khoản & Chính sách</a>
        </label>
        <button type="submit" class="w-full bg-primary text-white py-2 rounded-button font-medium">Đăng ký</button>
      </form>
      <div class="mt-4 text-center text-sm">
        Đã có tài khoản? <button id="switchToLogin" class="text-primary">Đăng nhập</button>
      </div>
    </div>
  </div>
</div>
