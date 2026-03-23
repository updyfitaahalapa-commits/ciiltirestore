<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Tailwind Components - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); }
        .nav-glow { box-shadow: 0 0 20px rgba(59, 130, 246, 0.1); }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col">

    <!-- Premium Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 border-b border-white/5 glass nav-glow">
        <div class="container mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center transform group-hover:rotate-12 transition-transform shadow-lg shadow-blue-500/20">
                    <i class="fas fa-gamepad text-white text-xl"></i>
                </div>
                <div>
                    <span class="text-xl font-bold tracking-tight text-white block leading-none">CIILTIRE</span>
                    <span class="text-[10px] font-bold tracking-[0.2em] text-blue-400 uppercase italic">Premium Store</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Home</a>
                <a href="#" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Packages</a>
                <a href="#" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Support</a>
                <div class="h-4 w-[1px] bg-white/10"></div>
                <a href="#" class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-500 rounded-full text-sm font-semibold transition-all shadow-lg shadow-blue-600/20 hover:-translate-y-0.5 active:translate-y-0">
                    <i class="fas fa-sign-in-alt opacity-70"></i>
                    Get Started
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/5 transition-colors">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content Placeholder -->
    <main class="flex-grow pt-32 pb-20 container mx-auto px-6">
        <div class="max-w-4xl">
            <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-white to-gray-500 bg-clip-text text-transparent italic">
                A Senior-Level Component Demonstration
            </h1>
            <p class="text-xl text-gray-400 leading-relaxed mb-12">
                This is a professional, minimalist implementation using <span class="text-blue-400 font-semibold">Tailwind CSS</span>. 
                It follows modern UI conventions: glassmorphism, precise spacing, and subtle micro-interactions.
            </p>
        </div>
    </main>

    <!-- Premium Footer -->
    <footer class="bg-gray-900 border-t border-white/5 pt-20 pb-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand -->
                <div class="space-y-6">
                    <a href="#" class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-gamepad text-white text-sm"></i>
                        </div>
                        <span class="text-lg font-bold tracking-tight">CIILTIRE STORE</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                        The ultimate destination for premium gaming credits and UC. Secure, instant, and professional.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600/20 hover:text-blue-400 transition-all">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600/20 hover:text-blue-400 transition-all">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600/20 hover:text-blue-400 transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Products -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-widest mb-6">Our Services</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">PUBG Mobile UC</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Global Diamonds</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Premium Scripts</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Elite Packages</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-widest mb-6">Support Center</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Refund Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Transaction FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Terms</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Expert</a></li>
                    </ul>
                </div>

                <!-- Newsletter/Contact -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-widest mb-6">Need Help?</h4>
                    <p class="text-gray-400 text-sm mb-4">Our support team is available 24/7 in Somali and English.</p>
                    <a href="mailto:support@ciiltire.com" class="text-blue-400 font-medium hover:underline flex items-center gap-2">
                        <i class="fas fa-envelope text-xs"></i>
                        support@ciiltire.com
                    </a>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-[13px] text-gray-500">
                <p>&copy; 2026 CIILTIRE STORE. Crafted for professionals.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-gray-400 transition-colors">Terms</a>
                    <a href="#" class="hover:text-gray-400 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-gray-400 transition-colors">Security</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
