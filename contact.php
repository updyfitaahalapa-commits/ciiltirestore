<?php
require_once 'config.php';
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nagala Soo Xiriiri - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .btn-whatsapp { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .btn-call { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        
        #headerDropdown { opacity: 0; transform: translateY(-10px); pointer-events: none; transition: all 0.3s ease; }
        #headerDropdown.active { opacity: 1; transform: translateY(0); pointer-events: auto; }

        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(45deg);
            transition: all 0.5s;
            opacity: 0;
        }
        .btn-shine:hover::after {
            left: 50%;
            top: 50%;
            opacity: 1;
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col pt-32">

    <!-- Premium Floating Navbar -->
    <nav class="fixed top-6 left-1/2 -translate-x-1/2 w-[92%] max-w-7xl z-50 glass-nav rounded-2xl shadow-sm px-6 py-4 flex items-center justify-between">
        <a href="index.php" class="flex items-center gap-3">
            <div class="w-10 h-10 btn-gradient rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-gamepad text-white text-lg"></i>
            </div>
            <div>
                <span class="text-xl font-bold tracking-tight text-slate-900 block leading-none">CIILTIRE</span>
                <span class="text-[10px] font-bold tracking-[0.2em] text-blue-600 uppercase italic">Store</span>
            </div>
        </a>

        <div class="hidden lg:flex items-center gap-10">
            <a href="index.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Home</a>
            <a href="shuruudaha.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Shuruudaha</a>
            <a href="lacagcelinta.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Lacag Celinta</a>
            <a href="faq.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">FAQ</a>
            <a href="contact.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors font-bold text-blue-600">Contact</a>
        </div>

        <div class="flex items-center gap-4">
            <?php if ($is_logged_in): ?>
                <a href="profile.php" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors text-slate-600">
                    <i class="fas fa-user"></i>
                </a>
            <?php
else: ?>
                <a href="login.php" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors px-4">Login</a>
            <?php
endif; ?>
            
            <button onclick="toggleDropdown()" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Dropdown -->
        <div id="headerDropdown" class="absolute top-[calc(100%+12px)] right-0 w-64 glass-card rounded-2xl shadow-xl p-4 flex flex-col gap-2">
            <a href="index.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-home text-blue-500 w-5"></i> Home
            </a>
            <a href="shuruudaha.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-file-alt text-blue-500 w-5"></i> Shuruudaha
            </a>
            <a href="faq.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-question-circle text-blue-500 w-5"></i> FAQ
            </a>
            <a href="contact.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-phone-alt text-blue-500 w-5"></i> Contact
            </a>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 pb-24 max-w-xl flex flex-col justify-center">
        <div class="text-center mb-12">
            <div class="w-20 h-20 btn-gradient rounded-[2.5rem] flex items-center justify-center text-white text-3xl mx-auto mb-8 shadow-xl shadow-blue-500/20 rotate-12">
                <i class="fas fa-headset"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-4 italic tracking-tight uppercase">Nagala Soo Xiriiri</h1>
            <p class="text-slate-500 font-medium text-lg leading-relaxed">
                Haddaa u baahantahay Caawinaad ama su'aal aad qabto, nala soo xiriir hadda.
            </p>
        </div>

        <div class="glass-card rounded-[40px] shadow-2xl p-8 md:p-12 text-center space-y-8 relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute -bottom-12 -left-12 w-32 h-32 bg-green-50 rounded-full blur-3xl opacity-50"></div>

            <div class="space-y-4">
                <!-- WhatsApp Button -->
                <a href="https://wa.me/252614148975" target="_blank" class="flex items-center justify-between p-6 rounded-3xl btn-whatsapp btn-shine text-white transition-all transform hover:scale-[1.02] hover:shadow-xl hover:shadow-green-500/20 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="text-left">
                            <span class="block text-[10px] font-black uppercase tracking-widest opacity-80">WhatsApp Us</span>
                            <span class="text-lg font-black italic tracking-tight">614148975</span>
                        </div>
                    </div>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>

                <!-- Call Button -->
                <a href="tel:+252614148975" class="flex items-center justify-between p-6 rounded-3xl btn-call btn-shine text-white transition-all transform hover:scale-[1.02] hover:shadow-xl hover:shadow-indigo-500/20 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="text-left">
                            <span class="block text-[10px] font-black uppercase tracking-widest opacity-80">Call Us Directly</span>
                            <span class="text-lg font-black italic tracking-tight">614148975</span>
                        </div>
                    </div>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
            </div>

            <div class="pt-6">
                <p class="text-slate-400 font-bold text-xs uppercase tracking-[0.2em] mb-4">Available 24/7 Support</p>
                <div class="flex justify-center gap-6">
                    <div class="flex items-center gap-2 text-slate-500 text-sm font-semibold">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        Online Now
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="index.php" class="inline-flex items-center gap-3 text-slate-400 hover:text-blue-600 font-bold transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Ku laabo Bogga Hore</span>
            </a>
        </div>
    </main>

    <!-- Professional Footer -->
    <footer class="bg-white border-t border-slate-100 pt-24 pb-12 px-6">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 border-b border-slate-100 pb-16 mb-12">
                <div class="space-y-6 col-span-1 lg:col-span-1.5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 btn-gradient rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-gamepad text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">CIILTIRE STORE</span>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Menu-ga</h4>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li><a href="index.php" class="hover:text-blue-600 transition-colors">Home</a></li>
                        <li><a href="shuruudaha.php" class="hover:text-blue-600 transition-colors">Shuruudaha</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Support</h4>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li><a href="faq.php" class="hover:text-blue-600 transition-colors">FAQ</a></li>
                        <li><a href="contact.php" class="hover:text-blue-600 transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Connect</h4>
                    <p class="text-sm font-semibold text-slate-500 mb-2">Haddii aad u baahantahay caawimaad:</p>
                    <a href="mailto:siidcalicabdulaahi93@gmail.com" class="text-blue-600 font-bold hover:underline block mb-4 text-xs">siidcalicabdulaahi93@gmail.com</a>
                    <a href="https://wa.me/252614148975" target="_blank" class="p-4 rounded-xl bg-slate-50 border border-slate-100 inline-block hover:bg-green-50 hover:border-green-200 transition-all group">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1 group-hover:text-green-600">WhatsApp</span>
                        <span class="text-slate-900 font-black group-hover:text-green-700">+252 61 4148975</span>
                    </a>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-[13px] font-bold text-slate-400">
                <p>&copy; <?php echo date('Y'); ?> CIILTIRE STORE. Dhamaan xuquuqda waa dhowran yihiin.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        function toggleDropdown() {
            document.getElementById('headerDropdown').classList.toggle('active');
        }
    </script>
</body>
</html>
