<?php
// payment.php - Premium Payment Instructions Page
require_once 'config.php';
$order_id = isset($_GET['order_id']) ? htmlspecialchars($_GET['order_id']) : '';

$conn = getDBConnection();
$order = null;

if ($order_id) {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();

if (!$order) {
    header("Location: index.php");
    exit();
}

$method = $order['payment_method'];
$price = $order['price'];
$uc_amount = $order['package_uc'];
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bixi Lacagta - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        
        @keyframes shine {
            0% { transform: translateX(-100%) skewX(-15deg); }
            100% { transform: translateX(200%) skewX(-15deg); }
        }
        .btn-shine-action { position: relative; overflow: hidden; }
        .btn-shine-action::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 50%; height: 100%;
            background: rgba(255, 255, 255, 0.2);
            animation: shine 2s infinite;
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col pt-32 relative overflow-x-hidden">

    <!-- Animated Background Elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-100 rounded-full blur-[120px] opacity-50 -z-10"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-sky-100 rounded-full blur-[120px] opacity-50 -z-10"></div>

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
        <div class="text-right">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Dalabkaaga</span>
            <span class="text-sm font-black text-slate-900 tracking-tight">#<?php echo $order_id; ?></span>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 pb-24 max-w-2xl flex flex-col justify-center">
        <div class="glass-card rounded-[40px] shadow-2xl p-8 md:p-12 text-center relative overflow-hidden">
            
            <div class="mb-10 relative">
                <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-green-500/10">
                    <i class="fas fa-check-double"></i>
                </div>
                <h1 class="text-3xl font-black text-slate-900 mb-2 italic uppercase tracking-tight">Dalabkaaga waa la helay!</h1>
                <p class="text-slate-500 font-medium text-lg">Fadlan hadda bixi lacagta si aad u hesho <strong class="text-blue-600"><?php echo number_format($uc_amount); ?> UC</strong></p>
            </div>

            <?php
$receiver = "614148975"; // Actual payment number
$formatted_price = number_format($price, 2);

// USSD Logistics
$ussd_base = "";
if ($method == 'Hormuud')
    $ussd_base = "*712*";
elseif ($method == 'Somnet')
    $ussd_base = "*812*";
elseif ($method == 'Sahal')
    $ussd_base = "*712*";
elseif ($method == 'eDahab')
    $ussd_base = "*101*";

$ussd_code = $ussd_base . $receiver . "*" . $formatted_price . "#";
$tel_uri = "tel:" . str_replace("#", "%23", $ussd_code);
?>

            <div class="space-y-8">
                <!-- Payment Method Badge -->
                <div class="inline-flex items-center gap-4 bg-white/50 border border-slate-100 rounded-2xl px-6 py-4 shadow-sm group hover:bg-white transition-colors">
                    <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-500 transition-colors">
                        <i class="fas fa-wallet text-xl"></i>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Habka Lacag-bixinta</span>
                        <span class="text-lg font-black text-slate-900 uppercase italic"><?php echo htmlspecialchars($method); ?></span>
                    </div>
                </div>

                <!-- Price Display -->
                <div class="py-10 rounded-[2.5rem] bg-slate-50 border-2 border-dashed border-slate-200">
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mb-2 leading-none">Lacagta Lagaa Rabaa</span>
                    <div class="flex items-center justify-center gap-2">
                        <span class="text-5xl font-black text-slate-900 tracking-tighter italic">$<?php echo $formatted_price; ?></span>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest bg-white px-3 py-1 rounded-lg shadow-sm">USD</span>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="space-y-6">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Riix badhanka hoose si aad u dirto lacagta</p>
                    
                    <a href="<?php echo $tel_uri; ?>" class="btn-gradient btn-shine-action text-white py-6 px-10 rounded-[2.5rem] font-black uppercase tracking-[0.2em] text-xs shadow-xl shadow-blue-500/20 hover:shadow-blue-500/40 transition-all flex items-center justify-center gap-4 group">
                        <i class="fas fa-mobile-screen text-xl group-hover:rotate-12 transition-transform"></i>
                        Garaac Hadda (<?php echo $ussd_code; ?>)
                    </a>

                    <div class="p-6 rounded-3xl bg-amber-50 border border-amber-100">
                        <span class="block text-[10px] font-black text-amber-600 uppercase tracking-widest mb-2 leading-none">Hadii badhanku kuu shaqayn waayo</span>
                        <code class="text-lg font-black text-amber-700 tracking-widest italic"><?php echo $ussd_code; ?></code>
                    </div>
                </div>

                <!-- Timeline / Warning -->
                <div class="pt-10 border-t border-slate-100 flex items-start gap-4 text-left">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                        <i class="fas fa-bolt text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-700 leading-relaxed mb-1 italic uppercase tracking-tight">Fulin Deg Deg Ah</p>
                        <p class="text-xs font-medium text-slate-400 leading-relaxed">Markii aad lacagta dirto, UC-gaaga waxaa laguugu soo ridi doonaa <strong class="text-blue-600">1-3 daqiiqo</strong> gudahood.</p>
                    </div>
                </div>

                <a href="profile.php" class="inline-flex items-center gap-2 text-slate-400 font-bold text-xs uppercase tracking-widest hover:text-blue-600 transition-colors">
                    Arag Dalabyadaada <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

        </div>
    </main>

    <!-- Professional Footer -->
    <footer class="bg-white border-t border-slate-100 py-12 px-6">
        <div class="container mx-auto text-center">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">&copy; <?php echo date('Y'); ?> CIILTIRE STORE. Dhamaan xuquuqda waa dhowran yihiin.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
