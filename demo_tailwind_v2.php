<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Light Glassmorphism Components - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); transition: all 0.3s ease; }
        .btn-gradient:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3); }
    </style>
</head>
<body class="text-slate-800">

    <!-- Light Glassmorphism Navbar -->
    <nav class="fixed top-6 left-1/2 -translate-x-1/2 w-[90%] max-w-6xl z-50 glass-nav rounded-2xl shadow-sm px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 btn-gradient rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-gamepad text-white text-lg"></i>
            </div>
            <span class="text-xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-600">CIILTIRE</span>
        </div>

        <div class="hidden md:flex items-center gap-10">
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">Home</a>
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">Products</a>
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">Contact</a>
            <a href="#" class="btn-gradient text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-soft">Get UC Instantly</a>
        </div>

        <button class="md:hidden text-slate-600"><i class="fas fa-bars text-xl"></i></button>
    </nav>

    <!-- Content Area -->
    <main class="pt-40 pb-20 container mx-auto px-6 text-center">
        <h2 class="text-6xl font-extrabold text-slate-900 mb-6 tracking-tight">
            Minimalist <span class="text-blue-600 underline decoration-blue-200 underline-offset-8">Glassmorphism</span>
        </h2>
        <p class="text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
            This variation focuses on whitespace, soft shadows, and clean typography. Perfect for a premium, trustworthy look.
        </p>
    </main>

    <!-- Clean Modern Footer -->
    <footer class="bg-white border-t border-slate-100 pt-24 pb-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-slate-100 pb-16 mb-12">
                <div class="col-span-1 md:col-span-1.5 space-y-6">
                    <h3 class="text-2xl font-bold text-slate-900">CIILTIRE STORE</h3>
                    <p class="text-slate-500 leading-relaxed max-w-sm">
                        Distributing excellence since 2024. The most trusted platform for secure gaming transactions in East Africa.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 border border-slate-100 rounded-lg flex items-center justify-center hover:bg-slate-50 transition-colors"><i class="fab fa-whatsapp text-green-500"></i></a>
                        <a href="#" class="w-10 h-10 border border-slate-100 rounded-lg flex items-center justify-center hover:bg-slate-50 transition-colors"><i class="fab fa-facebook text-blue-600"></i></a>
                        <a href="#" class="w-10 h-10 border border-slate-100 rounded-lg flex items-center justify-center hover:bg-slate-50 transition-colors"><i class="fab fa-instagram text-pink-500"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6">Quick Actions</h4>
                    <ul class="space-y-4 text-sm font-medium text-slate-500">
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Start Order</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Pricing List</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">User Dashboard</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Support Ticket</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6">Company</h4>
                    <ul class="space-y-4 text-sm font-medium text-slate-500">
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Terms of Use</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">FAQ Support</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Refund Center</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6">Contact Info</h4>
                    <div class="space-y-4 text-sm font-medium text-slate-500">
                        <p class="flex items-center gap-3"><i class="fas fa-envelope text-blue-500"></i> hello@ciiltire.com</p>
                        <p class="flex items-center gap-3"><i class="fas fa-phone text-blue-500"></i> +252 61 XXX XX XX</p>
                        <p class="flex items-center gap-3"><i class="fas fa-map-marker-alt text-blue-500"></i> Mogadishu, Somalia</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center text-sm font-medium text-slate-400 gap-4">
                <p>&copy; 2026 CIILTIRE STORE. All rights reserved.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-slate-600 transition-colors underline-offset-4 hover:underline">Accessibility</a>
                    <a href="#" class="hover:text-slate-600 transition-colors underline-offset-4 hover:underline">Global Terms</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
