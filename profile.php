<?php
require_once 'config.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Get user details from database
$conn = getDBConnection(); // Fetch user details
$sql = "SELECT full_name, mobile_number, region, district, created_at FROM users WHERE id = $user_id";
$user_result = $conn->query($sql);
$user = $user_result->fetch_assoc();

// Fetch recent orders
$orders_sql = "SELECT order_id, package_uc, price, status, created_at FROM orders WHERE user_id = $user_id ORDER BY created_at DESC LIMIT 5";
$orders_result = $conn->query($orders_sql);
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile-kayga - CIILTIRE STORE</title>
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

        .status-badge { padding: 4px 12px; border-radius: 99px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; }
        .status-completed, .status-Completed { background: #dcfce7; color: #166534; }
        .status-pending, .status-Pending { background: #fef9c3; color: #854d0e; }
        .status-cancelled, .status-Cancelled { background: #fee2e2; color: #991b1b; }
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
            <a href="profile.php" class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shadow-sm border border-blue-100">
                <i class="fas fa-user text-sm"></i>
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
            <a href="faq.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-question-circle text-blue-500 w-5"></i> FAQ
            </a>
            <a href="contact.php" class="px-4 py-3 rounded-xl hover:bg-blue-50 text-slate-700 font-medium flex items-center gap-3 transition-colors">
                <i class="fas fa-phone-alt text-blue-500 w-5"></i> Contact
            </a>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 pb-24 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Sidebar / User Info -->
            <div class="lg:col-span-4 space-y-6">
                <div class="glass-card rounded-[40px] shadow-2xl p-8 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-24 btn-gradient opacity-10"></div>
                    <div class="relative pt-4">
                        <div class="w-24 h-24 rounded-[2.5rem] bg-blue-50 flex items-center justify-center text-blue-600 text-4xl mx-auto mb-6 shadow-xl shadow-blue-500/10 rotate-3">
                            <i class="fas fa-user-astronaut"></i>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 mb-1 tracking-tight italic uppercase"><?php echo htmlspecialchars($user['full_name']); ?></h2>
                        <p class="text-blue-600 font-bold text-[10px] uppercase tracking-[0.2em] mb-8">Xubin Qiimo Leh</p>
                        
                        <div class="space-y-4 text-left px-4">
                            <div class="p-4 rounded-2xl bg-white/50 border border-slate-100 flex items-center gap-4 group hover:bg-blue-50 transition-colors">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-white group-hover:text-blue-500 transition-colors">
                                    <i class="fas fa-phone-alt text-sm"></i>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Mobile</span>
                                    <span class="text-sm font-bold text-slate-700"><?php echo htmlspecialchars($user['mobile_number']); ?></span>
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/50 border border-slate-100 flex items-center gap-4 group hover:bg-blue-50 transition-colors">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-white group-hover:text-blue-500 transition-colors">
                                    <i class="fas fa-map-marker-alt text-sm"></i>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Location</span>
                                    <span class="text-sm font-bold text-slate-700"><?php echo htmlspecialchars($user['region']); ?>, <?php echo htmlspecialchars($user['district']); ?></span>
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/50 border border-slate-100 flex items-center gap-4 group hover:bg-blue-50 transition-colors">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-white group-hover:text-blue-500 transition-colors">
                                    <i class="fas fa-clock text-sm"></i>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Joined</span>
                                    <span class="text-sm font-bold text-slate-700"><?php echo date('M Y', strtotime($user['created_at'])); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 pt-8 border-t border-slate-100">
                            <a href="logout.php" class="inline-flex items-center justify-center gap-3 w-full py-4 rounded-2xl bg-slate-50 text-slate-400 font-bold text-sm uppercase tracking-widest hover:bg-red-50 hover:text-red-500 transition-all">
                                <i class="fas fa-sign-out-alt"></i> Logout / Ka bax
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area / Orders -->
            <div class="lg:col-span-8">
                <div class="glass-card rounded-[40px] shadow-2xl p-8 md:p-12 overflow-hidden">
                    <div class="flex items-center justify-between mb-10">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl btn-gradient flex items-center justify-center text-white shadow-lg">
                                <i class="fas fa-shopping-bag text-lg"></i>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 uppercase italic tracking-tight">Dalabyadii u dambeeyay</h3>
                        </div>
                        <a href="index.php#packages" class="text-sm font-bold text-blue-600 hover:underline">Hadda Dalbo <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>

                    <div class="overflow-x-auto -mx-8 md:-mx-12">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50/50">
                                <tr>
                                    <th class="px-8 md:px-12 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">ID</th>
                                    <th class="py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Package</th>
                                    <th class="py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Price</th>
                                    <th class="py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                                    <th class="px-8 md:px-12 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php if ($orders_result->num_rows > 0): ?>
                                    <?php while($order = $orders_result->fetch_assoc()): ?>
                                        <tr class="hover:bg-blue-50/30 transition-colors duration-300">
                                            <td class="px-8 md:px-12 py-6">
                                                <span class="text-sm font-black text-slate-900 tracking-tight">#<?php echo htmlspecialchars($order['order_id']); ?></span>
                                            </td>
                                            <td class="py-6">
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-fire text-amber-500 text-xs"></i>
                                                    <span class="text-sm font-bold text-slate-700"><?php echo number_format($order['package_uc']); ?> UC</span>
                                                </div>
                                            </td>
                                            <td class="py-6 whitespace-nowrap">
                                                <span class="text-sm font-black text-slate-900 tracking-tight italic">$<?php echo number_format($order['price'], 2); ?></span>
                                            </td>
                                            <td class="py-6">
                                                <span class="status-badge status-<?php echo strtolower($order['status']); ?>">
                                                    <?php echo htmlspecialchars($order['status']); ?>
                                                </span>
                                            </td>
                                            <td class="px-8 md:px-12 py-6 text-right whitespace-nowrap">
                                                <span class="text-[11px] font-bold text-slate-400"><?php echo date('d M, Y', strtotime($order['created_at'])); ?></span>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="py-20 text-center">
                                            <div class="max-w-xs mx-auto">
                                                <i class="fas fa-box-open text-5xl text-slate-200 mb-6 block"></i>
                                                <p class="text-slate-400 font-bold text-sm leading-relaxed mb-8">Wali wax dalab ah ma jiraan.</p>
                                                <a href="index.php#packages" class="inline-flex items-center justify-center border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-blue-600 hover:text-white transition-all">Hadda Dalbo</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Feedback</h4>
                    <p class="text-slate-500 text-xs font-semibold leading-relaxed mb-4">Waad ku mahadsantahay isticmaalka adeegeena Ciiltire Store.</p>
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
<?php $conn->close(); ?>
