<?php
require_once 'config.php';
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacag Celinta (Refund Policy) - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        
        #headerDropdown { opacity: 0; transform: translateY(-10px); pointer-events: none; transition: all 0.3s ease; }
        #headerDropdown.active { opacity: 1; transform: translateY(0); pointer-events: auto; }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col pt-24 md:pt-32">

    <!-- Premium Floating Navbar -->
    <nav class="fixed top-4 md:top-6 left-1/2 -translate-x-1/2 w-[95%] md:w-[92%] max-w-7xl z-50 glass-nav rounded-2xl shadow-sm px-4 md:px-6 py-3 md:py-4 flex items-center justify-between">
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
            <a href="lacagcelinta.php" class="text-sm font-semibold text-blue-600 transition-colors">Lacag Celinta</a>
            <a href="faq.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">FAQ</a>
            <a href="contact.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Contact</a>
        </div>

        <div class="flex items-center gap-4">
            <?php if ($is_logged_in): ?>
                <a href="profile.php" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors text-slate-600">
                    <i class="fas fa-user"></i>
                </a>
            <?php else: ?>
                <a href="login.php" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors px-4">Login</a>
            <?php endif; ?>
            
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
            <a href="lacagcelinta.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-sync-alt text-blue-500 w-5"></i> Lacag Celinta
            </a>
            <a href="faq.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-question-circle text-blue-500 w-5"></i> FAQ
            </a>
            <a href="contact.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-phone-alt text-blue-500 w-5"></i> Contact
            </a>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 md:px-6 pb-16 md:pb-24 max-w-4xl">
        <div class="text-center mb-10 md:mb-16">
            <div class="w-20 h-20 btn-gradient rounded-[2.5rem] flex items-center justify-center text-white text-3xl mx-auto mb-8 shadow-xl shadow-blue-500/20 rotate-6">
                <i class="fas fa-undo-alt"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-4 italic tracking-tight uppercase">Lacag Celinta</h1>
            <p class="text-slate-500 font-medium text-lg">Fadlan si taxadar leh u aqri shuruudaha lacag celinta (Refund Policy).</p>
        </div>

        <div class="glass-card rounded-3xl md:rounded-[40px] shadow-2xl p-6 md:p-16 space-y-8 md:space-y-12">
            
            <section class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-sm">
                        <i class="fas fa-shield-alt text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase italic tracking-tight">Shuruudaha Guud</h2>
                </div>
                <div class="space-y-4 text-slate-600 leading-relaxed font-medium pl-16">
                    <p>1. Lacag celintu waxay suurtagal tahay oo kaliya haddii dalabkaaga uusan weli fulin (Pending).</p>
                    <p>2. Haddii UC-gu uu gaaro Player ID-ga aad bixisay, ma jiri karto wax lacag celin ah madaama adeeggu yahay mid digitalka ah.</p>
                </div>
            </section>

            <section class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-sm">
                        <i class="fas fa-exclamation-triangle text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase italic tracking-tight">Khaladaadka Player ID</h2>
                </div>
                <div class="space-y-4 text-slate-600 leading-relaxed font-medium pl-16 border-l-4 border-blue-500/10">
                    <p>Fadlan iska hubi Player ID-gaaga ka hor inta aadan dalban. Ciiltire Store mas'uul kama aha haddii aad bixisay ID khaldan oo UC-ga loo diray qof kale.</p>
                </div>
            </section>

            <section class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-sm">
                        <i class="fas fa-clock text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase italic tracking-tight">Waqtiga Fulinta</h2>
                </div>
                <div class="space-y-4 text-slate-600 leading-relaxed font-medium pl-16">
                    <p>Haddii dalabku uusan fulin 24 saac gudahood, waxaad xaq u leedahay inaad dalbato lacag celin adoo la xiriiraya support-keena.</p>
                </div>
            </section>

        </div>

        <div class="mt-10 md:mt-16 text-center">
            <a href="contact.php" class="btn-gradient text-white px-10 py-5 rounded-[2rem] font-black uppercase tracking-widest text-xs shadow-xl shadow-blue-500/20 inline-flex items-center gap-3">
                <i class="fas fa-headset"></i> Support La Xiriir
            </a>
        </div>
    </main>

    <!-- Professional Footer -->
    <footer class="bg-white border-t border-slate-100 pt-12 md:pt-24 pb-8 md:pb-12 px-4 md:px-6">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 border-b border-slate-100 pb-10 md:pb-16 mb-8 md:mb-12">
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

    <script>
        function toggleDropdown() {
            document.getElementById('headerDropdown').classList.toggle('active');
        }
    </script>
</body>
</html>
