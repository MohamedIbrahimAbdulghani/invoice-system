<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فواتير - نظام إدارة الفواتير</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">فواتير</h1>
            <ul class="hidden md:flex space-x-6 space-x-reverse">
                <li><a href="#features" class="hover:text-blue-600">المميزات</a></li>
                <li><a href="#pricing" class="hover:text-blue-600">الأسعار</a></li>
                <li><a href="#contact" class="hover:text-blue-600">تواصل معنا</a></li>
            </ul>
            <div class="space-x-3 space-x-reverse">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">تسجيل الدخول</a>
                {{-- <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">إنشاء حساب</a> --}}
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-32 bg-gradient-to-b from-blue-100 to-white mt-16">
        <h2 class="text-5xl font-bold mb-4 text-blue-700">إدارة فواتيرك بسهولة واحترافية</h2>
        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
            أنشئ، عدّل، وتابع فواتير عملائك بكل سهولة في نظام موحد.
            فواتيرك في أمان — وكل عميل له سجل خاص به.
        </p>
        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-700">
            جرّب الآن مجانًا
        </a>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-blue-700 mb-12">مميزات النظام</h3>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-3 text-blue-600">إدارة الفواتير</h4>
                    <p class="text-gray-600">إنشاء وتعديل وحذف الفواتير بسرعة، مع إمكانية تحميلها PDF أو إرسالها بالبريد.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-3 text-blue-600">إدارة العملاء</h4>
                    <p class="text-gray-600">احتفظ بسجل دقيق لكل عميل وتاريخه الشرائي لتتبع الأداء بسهولة.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-3 text-blue-600">تقارير وإحصائيات</h4>
                    <p class="text-gray-600">احصل على ملخص شامل للفواتير والمدفوعات عبر تقارير ذكية.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="py-20 bg-gray-100 text-center">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-blue-700 mb-12">خطط الأسعار</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-8 shadow hover:shadow-xl transition">
                    <h4 class="text-xl font-semibold mb-2">الخطة المجانية</h4>
                    <p class="text-gray-600 mb-4">للتجربة الشخصية</p>
                    <p class="text-4xl font-bold mb-6">0 ج.م</p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>✔ حتى 10 فواتير</li>
                        <li>✔ إدارة عميلين</li>
                        <li>✖ بدون تقارير</li>
                    </ul>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">ابدأ الآن</a>
                </div>
                <div class="bg-white rounded-xl p-8 shadow-lg border-2 border-blue-600">
                    <h4 class="text-xl font-semibold mb-2">الخطة الاحترافية</h4>
                    <p class="text-gray-600 mb-4">للشركات الصغيرة</p>
                    <p class="text-4xl font-bold mb-6">99 ج.م / شهر</p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>✔ عدد غير محدود من الفواتير</li>
                        <li>✔ دعم فني مميز</li>
                        <li>✔ تقارير وتحليلات</li>
                    </ul>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">ابدأ الآن</a>
                </div>
                <div class="bg-white rounded-xl p-8 shadow hover:shadow-xl transition">
                    <h4 class="text-xl font-semibold mb-2">الخطة المؤسسية</h4>
                    <p class="text-gray-600 mb-4">للشركات الكبيرة</p>
                    <p class="text-4xl font-bold mb-6">199 ج.م / شهر</p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>✔ فواتير غير محدودة</li>
                        <li>✔ صلاحيات متعددة للمستخدمين</li>
                        <li>✔ تقارير مخصصة</li>
                    </ul>
                    {{-- <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">تواصل معنا</a> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="py-20 bg-white text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-blue-700 mb-6">تواصل معنا</h3>
            <p class="text-gray-600 mb-8">هل لديك استفسار؟ نحن هنا للمساعدة.</p>
            <a href="mailto:mohamedibrahimabdulgahni@gmail.com" class="text-blue-600 font-semibold text-lg hover:underline">mohamedibrahimabdulgahni@gmail.com</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 text-center">
        <p>© {{ date('Y') }} فواتير - جميع الحقوق محفوظة.</p>
    </footer>

</body>
</html>
