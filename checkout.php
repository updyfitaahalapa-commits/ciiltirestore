<?php
require_once 'config.php';
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : '';

// Redirect to login if not logged in
if (!$is_logged_in) {
    $redirect_args = isset($_GET['package']) ? '?package=' . urlencode($_GET['package']) : '';
    header("Location: login.php" . $redirect_args);
    exit();
}

$selected_package = isset($_GET['package']) ? $_GET['package'] : '';
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .btn-gradient:hover { transform: translateY(-2px); box-shadow: 0 12px 20px -5px rgba(37, 99, 235, 0.3); }
        
        .payment-option input:checked + .option-content {
            border-color: #2563eb;
            background-color: #eff6ff;
            box-shadow: 0 0 0 1px #2563eb;
        }

        #headerDropdown { opacity: 0; transform: translateY(-10px); pointer-events: none; transition: all 0.3s ease; }
        #headerDropdown.active { opacity: 1; transform: translateY(0); pointer-events: auto; }
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
            <a href="contact.php" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Contact</a>
        </div>

        <div class="flex items-center gap-4">
            <a href="profile.php" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors text-slate-600">
                <i class="fas fa-user"></i>
            </a>
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

    <main class="flex-grow container mx-auto px-6 pb-24 max-w-4xl">
        <a href="index.php" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 font-bold text-sm mb-8 transition-colors group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            Dib u noqo (Home)
        </a>

        <div class="glass-card rounded-[40px] shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-sky-500 p-12 text-center">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-white text-2xl mx-auto mb-6">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h1 class="text-3xl font-black text-white italic uppercase tracking-tight mb-2">Hadda Dalbo UC-gaaga</h1>
                <p class="text-blue-50 font-medium">Buuxi macluumaadka hoos ku qoran si aad u hesho UC-daada.</p>
            </div>

            <form id="orderForm" action="process_order.php" method="POST" class="p-8 md:p-12 space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="playerId" class="text-sm font-black text-slate-700 uppercase tracking-widest pl-1">ID-ga Game-ka *</label>
                        <div class="relative group">
                            <i class="fas fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="text" id="playerId" name="playerId" placeholder="Geli Player ID-gaaga" required 
                                   class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="gameName" class="text-sm font-black text-slate-700 uppercase tracking-widest pl-1">Magaca Game-ka *</label>
                        <div class="relative group">
                            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="text" id="gameName" name="gameName" placeholder="Geli Magacaaga Game-ka" required 
                                   class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="package" class="text-sm font-black text-slate-700 uppercase tracking-widest pl-1">Xirmada UC *</label>
                        <div class="relative group">
                            <i class="fas fa-box absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors pointer-events-none"></i>
                            <select id="package" name="package" required 
                                    class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold appearance-none">
                                <option value="">Choose a package</option>
                                <?php
                                $conn = getDBConnection();
                                $sql = "SELECT id, uc_amount, price FROM packages WHERE is_active = 1";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                                    $selected = ($selected_package == $row['uc_amount']) ? 'selected' : '';
                                    echo "<option value='{$row['uc_amount']}' $selected>{$row['uc_amount']} UC - \${$row['price']}</option>";
                                }
                                $conn->close();
                                ?>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="paymentNumber" class="text-sm font-black text-slate-700 uppercase tracking-widest pl-1">Number-ka Lacagta *</label>
                        <div class="relative group">
                            <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="tel" id="paymentNumber" name="paymentNumber" placeholder="Geli nambarkaaga lacagta" required 
                                   class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold">
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="text-sm font-black text-slate-700 uppercase tracking-widest pl-1 block text-center">Dooro Habka Lacag Bixinta *</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="payment-option cursor-pointer group">
                            <input type="radio" name="payment_method" value="Hormuud" required class="hidden">
                            <div class="option-content p-6 rounded-2xl border-2 border-slate-100 bg-slate-50 flex flex-col items-center gap-4 transition-all group-hover:border-blue-200 group-hover:bg-white">
                                <img src="assets/images/hormuud.png" alt="Hormuud" class="h-10 object-contain grayscale group-hover:grayscale-0 transition-all">
                                <span class="font-bold text-slate-600">Hormuud (EVC Plus)</span>
                            </div>
                        </label>
                        <label class="payment-option cursor-pointer group">
                            <input type="radio" name="payment_method" value="Somnet" required class="hidden">
                            <div class="option-content p-6 rounded-2xl border-2 border-slate-100 bg-slate-50 flex flex-col items-center gap-4 transition-all group-hover:border-blue-200 group-hover:bg-white">
                                <img src="assets/images/somnet.png" alt="Somnet" class="h-10 object-contain grayscale group-hover:grayscale-0 transition-all">
                                <span class="font-bold text-slate-600">Somnet</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-3xl p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-6 text-center border border-blue-100">
                    <div>
                        <span class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">Xilliga imaatinka</span>
                        <span class="text-blue-900 font-bold">Deg-deg (Instant)</span>
                    </div>
                    <div class="border-y md:border-y-0 md:border-x border-blue-200 py-4 md:py-0">
                        <span class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">Habka Ammaanka</span>
                        <span class="text-blue-900 font-bold">Secure Checkout</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">Caawinaadda</span>
                        <span class="text-blue-900 font-bold">24/7 Available</span>
                    </div>
                </div>

                <button type="submit" class="w-full btn-gradient text-white py-5 rounded-2xl font-black uppercase tracking-widest shadow-xl shadow-blue-500/20 text-lg">
                    Hadda Dhamaystir Booska
                </button>
                
                <p class="text-center text-slate-400 text-xs font-medium px-4">
                    Markaad dalbatid, waxaad ogolaatay <a href="shuruudaha.php" class="text-blue-500 hover:underline">Shuruudaha Adeegga</a> iyo <a href="#" class="text-blue-500 hover:underline">Siyaasadda Khaaska ah</a>.
                </p>
            </form>
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
                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm font-medium">
                        Waa goobta loogu talagalay inay kuu sahlanto helista UC PUBG Mobile adoo jooga gurigaaga.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Menu-ga</h4>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li><a href="index.php" class="hover:text-blue-600 transition-colors">Home</a></li>
                        <li><a href="shuruudaha.php" class="hover:text-blue-600 transition-colors">Shuruudaha</a></li>
                        <li><a href="faq.php" class="hover:text-blue-600 transition-colors">FAQ Support</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Account</h4>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li><a href="profile.php" class="hover:text-blue-600 transition-colors">My Profile</a></li>
                        <li><a href="contact.php" class="hover:text-blue-600 transition-colors">Support Connect</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Connect</h4>
                    <a href="mailto:support@ciiltire.com" class="text-blue-600 font-bold hover:underline block mb-4">support@ciiltire.com</a>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 inline-block">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">WhatsApp Support</span>
                        <span class="text-slate-900 font-black">+252 61 XXX XX XX</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-[13px] font-bold text-slate-400">
                <p>&copy; <?php echo date('Y'); ?> CIILTIRE STORE. Dhamaan xuquuqda waa dhowran yihiin.</p>
                <div class="flex gap-8">
                    <a href="shuruudaha.php" class="hover:text-slate-600 transition-colors">Terms</a>
                    <a href="lacagcelinta.php" class="hover:text-slate-600 transition-colors">Refunds</a>
                </div>
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
",Complexity:2,Description:
