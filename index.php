<?php
require_once 'config.php';
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : '';
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIILTIRE STORE - PUBG UC & Gaming Credit</title>
    <meta name="description" content="Hadda ka iibso UC PUBG Mobile CIILTIRE STORE. Waxaan bixinaa adeeg degdeg ah iyo qiimo jaban.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .btn-gradient:hover { transform: translateY(-2px); box-shadow: 0 12px 20px -5px rgba(37, 99, 235, 0.3); }
        .hero-gradient { background: radial-gradient(circle at top right, rgba(14, 165, 233, 0.05), transparent), radial-gradient(circle at bottom left, rgba(37, 99, 235, 0.05), transparent); }
        
        .popular-border { position: relative; }
        .popular-border::before {
            content: ''; position: absolute; inset: -2px;
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            border-radius: 24px; z-index: -1;
        }

        /* Dropdown Animation */
        #headerDropdown { opacity: 0; transform: translateY(-10px); pointer-events: none; transition: all 0.3s ease; }
        #headerDropdown.active { opacity: 1; transform: translateY(0); pointer-events: auto; }
    </style>
</head>
<body class="text-slate-800 hero-gradient min-h-screen">

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
            <a href="contact.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Contact</a>
        </div>

        <div class="flex items-center gap-4">
            <?php if ($is_logged_in): ?>
                <a href="profile.php" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors text-slate-600">
                    <i class="fas fa-user"></i>
                </a>
            <?php
else: ?>
                <a href="login.php" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors px-4">Login</a>
                <a href="register.php" class="hidden sm:block btn-gradient text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-soft">Sign Up</a>
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

    <!-- Hero Section -->
    <header class="pt-48 pb-24 px-6 text-center">
        <div class="container mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-widest mb-8 animate-bounce">
                <i class="fas fa-fire"></i> New Season Offers
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 mb-8 tracking-tight leading-tight italic">
                Hel <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-500">PUBG UC</span> <br class="hidden md:block"> Si Degdeg Ah oo Amaan
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed mb-12">
                Goobta ugu kalsoonida badan ee PUBG Mobile. Waxaan bixinaa adeeg degdeg ah, hufan, iyo qiimo ku cajab geliya.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="#packages" class="w-full sm:w-auto btn-gradient text-white px-10 py-4 rounded-2xl font-extrabold shadow-lg shadow-blue-500/20 text-lg">
                    Browse Packages
                </a>
                <a href="#how-it-works" class="w-full sm:w-auto bg-white border border-slate-200 text-slate-700 px-10 py-4 rounded-2xl font-extrabold hover:bg-slate-50 transition-colors text-lg">
                    How it Works
                </a>
            </div>
        </div>
    </header>

    <!-- Packages Section -->
    <section id="packages" class="py-24 px-6 bg-white/50">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-slate-900 mb-4 italic uppercase tracking-tight">Xirmooyinka UC</h2>
                <div class="h-1.5 w-24 btn-gradient mx-auto rounded-full mb-6"></div>
                <p class="text-slate-500 font-medium">Dooro xirmada kugu haboon si aad isla dhow u hesho.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php
$conn = getDBConnection();
$sql = "SELECT * FROM packages WHERE is_active = 1 ORDER BY price ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
        $is_popular = $row['is_popular'];
?>
                    <div class="group relative <?php echo $is_popular ? 'popular-border' : ''; ?>">
                        <div class="h-full glass-card rounded-3xl p-8 flex flex-col transition-all group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:shadow-blue-500/10">
                            <?php if ($is_popular): ?>
                                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-600 to-sky-500 text-white text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                                    <i class="fas fa-star mr-1"></i> Popular
                                </div>
                            <?php
        endif; ?>

                            <div class="flex items-center justify-between mb-8">
                                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-2xl group-hover:scale-110 transition-transform">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div class="text-right">
                                    <span class="block text-3xl font-black text-slate-900"><?php echo $row['uc_amount']; ?></span>
                                    <span class="text-xs font-bold text-blue-500 uppercase tracking-widest leading-none">UC</span>
                                </div>
                            </div>

                            <div class="text-4xl font-black text-slate-900 mb-8">$<?php echo number_format($row['price'], 2); ?></div>

                            <ul class="space-y-4 mb-10 flex-grow">
                                <li class="flex items-center gap-3 text-sm font-medium text-slate-600">
                                    <div class="w-5 h-5 rounded-full bg-green-50 text-green-500 flex items-center justify-center text-[10px]"><i class="fas fa-check"></i></div>
                                    Instant Delivery
                                </li>
                                <li class="flex items-center gap-3 text-sm font-medium text-slate-600">
                                    <div class="w-5 h-5 rounded-full bg-green-50 text-green-500 flex items-center justify-center text-[10px]"><i class="fas fa-check"></i></div>
                                    Secure Transaction
                                </li>
                                <li class="flex items-center gap-3 text-sm font-medium text-slate-600">
                                    <div class="w-5 h-5 rounded-full bg-green-50 text-green-500 flex items-center justify-center text-[10px]"><i class="fas fa-check"></i></div>
                                    24/7 Support
                                </li>
                            </ul>

                            <button onclick="<?php echo $is_logged_in ? "selectPackage('{$row['uc_amount']}')" : "redirectToLogin('{$row['uc_amount']}')"; ?>" 
                                    class="w-full py-4 rounded-2xl font-black uppercase tracking-widest text-sm transition-all
                                    <?php echo $is_popular ? 'btn-gradient text-white shadow-lg shadow-blue-500/20' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">
                                Hadda Iibso
                            </button>
                        </div>
                    </div>
                <?php
    endwhile;
endif;
$conn->close();
?>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 px-6">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto glass-card rounded-[40px] p-12 md:p-20 relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-100/50 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-sky-100/50 rounded-full blur-3xl"></div>
                
                <div class="text-center mb-16 relative">
                    <h2 class="text-3xl font-black text-slate-900 mb-4 italic uppercase tracking-tight">Sidee ayay u shaqaysaa?</h2>
                    <p class="text-slate-500 font-medium">Saddex talaabo oo fudud ayaad ku heli kartaa UC-gaaga.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl font-black mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all shadow-sm">1</div>
                        <h3 class="font-bold text-slate-900 mb-3">Player ID</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">Gali ID-gaaga PUBG Mobile si sax ah.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl font-black mx-auto mb-6 group-hover:scale-110 group-hover:-rotate-6 transition-all shadow-sm">2</div>
                        <h3 class="font-bold text-slate-900 mb-3">Bixinta Lacagta</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">Dooro xirmadaada oo ku bixi EVC Plus ama Somnet.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl font-black mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all shadow-sm">3</div>
                        <h3 class="font-bold text-slate-900 mb-3">Hadda Hesho</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">UC-gaaga ayaa isla dhow laguugu soo shubi doonaa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm font-medium">
                        Waa goobta loogu talagalay inay kuu sahlanto helista UC PUBG Mobile adoo jooga gurigaaga. Ammaan iyo xawaare waa halkudhegeenna.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 transition-colors text-slate-600">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 transition-colors text-slate-600">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 transition-colors text-slate-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Menu-ga</h4>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li><a href="index.php" class="hover:text-blue-600 transition-colors">Home</a></li>
                        <li><a href="shuruudaha.php" class="hover:text-blue-600 transition-colors">Shuruudaha</a></li>
                        <li><a href="lacagcelinta.php" class="hover:text-blue-600 transition-colors">Lacag Celinta</a></li>
                        <li><a href="faq.php" class="hover:text-blue-600 transition-colors">FAQ Support</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Account</h4>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li><a href="profile.php" class="hover:text-blue-600 transition-colors">My Profile</a></li>
                        <li><a href="login.php" class="hover:text-blue-600 transition-colors">Login</a></li>
                        <li><a href="register.php" class="hover:text-blue-600 transition-colors">Sign Up</a></li>
                        <li><a href="contact.php" class="hover:text-blue-600 transition-colors">Support Connect</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Connect</h4>
                    <p class="text-sm font-semibold text-slate-500 mb-2">Haddii aad u baahantahay caawimaad:</p>
                    <a href="mailto:siidcalicabdulaahi93@gmail.com" class="text-blue-600 font-bold hover:underline block mb-4">siidcalicabdulaahi93@gmail.com</a>
                    <a href="https://wa.me/252614148975" target="_blank" class="p-4 rounded-2xl bg-slate-50 border border-slate-100 inline-block hover:bg-green-50 hover:border-green-200 transition-all group">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1 group-hover:text-green-600">WhatsApp Support</span>
                        <span class="text-slate-900 font-black group-hover:text-green-700">+252 61 4148975</span>
                    </a>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-[13px] font-bold text-slate-400">
                <p>&copy; <?php echo date('Y'); ?> CIILTIRE STORE. Dhamaan xuquuqda waa dhowran yihiin.</p>
                <div class="flex gap-8">
                    <a href="shuruudaha.php" class="hover:text-slate-600 transition-colors">Terms</a>
                    <a href="lacagcelinta.php" class="hover:text-slate-600 transition-colors">Refunds</a>
                    <a href="#" class="hover:text-slate-600 transition-colors italic">Premium Gaming Hub</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        function toggleDropdown() {
            document.getElementById('headerDropdown').classList.toggle('active');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.closest('.header-actions') && !event.target.closest('#headerDropdown')) {
                var dropdown = document.getElementById('headerDropdown');
                if (dropdown.classList.contains('active')) {
                    dropdown.classList.remove('active');
                }
            }
        }

        function selectPackage(amount) {
            window.location.href = 'checkout.php?package=' + amount;
        }

        function redirectToLogin(amount) {
            window.location.href = 'login.php?redirect=checkout.php&package=' + amount;
        }
    </script>
</body>
</html>