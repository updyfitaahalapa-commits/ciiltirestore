<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soo Logow - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .btn-gradient:hover { transform: translateY(-2px); shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4); }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex py-10 px-6 relative overflow-x-hidden">
    
    <!-- Animated Background Elements -->
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-100 rounded-full blur-[120px] opacity-50 pointer-events-none"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-sky-100 rounded-full blur-[120px] opacity-50 pointer-events-none"></div>

    <div class="w-full max-w-[440px] m-auto relative z-10">
        <div class="glass-card rounded-[40px] shadow-2xl p-8 md:p-12">
            <div class="text-center mb-10">
                <a href="index.php" class="inline-flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 btn-gradient rounded-2xl flex items-center justify-center shadow-lg rotate-3">
                        <i class="fas fa-gamepad text-white text-xl"></i>
                    </div>
                    <div class="text-left">
                        <span class="text-2xl font-black tracking-tight text-slate-900 block leading-none">CIILTIRE</span>
                        <span class="text-[10px] font-bold tracking-[0.3em] text-blue-600 uppercase italic">Store</span>
                    </div>
                </a>
                <h2 class="text-3xl font-black text-slate-900 mb-2 italic uppercase tracking-tight">Soo Dhawaw</h2>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Gali macluumaadkaaga halkan</p>
            </div>

            <form action="auth_process.php" method="POST" class="space-y-6">
                <input type="hidden" name="action" value="login">
                <?php if (isset($_GET['package'])): ?>
                    <input type="hidden" name="package" value="<?php echo htmlspecialchars($_GET['package']); ?>">
                <?php
endif; ?>

                <div class="space-y-2">
                    <label for="mobile_number" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Mobile or Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-5 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-user-circle text-sm"></i>
                        </div>
                        <input type="text" id="mobile_number" name="mobile_number" placeholder="Mobile ama Username" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-5 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-lock text-sm"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="********" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>
                </div>

                <?php if (isset($_GET['error'])): ?>
                    <div class="p-4 rounded-2xl bg-red-50 border border-red-100 text-red-500 text-xs font-bold text-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?php
    if ($_GET['error'] == 'invalid_creds')
        echo "Nambarka ama Password-ka waa khalad!";
    if ($_GET['error'] == 'not_found')
        echo "Account-kan ma jiro!";
?>
                    </div>
                <?php
endif; ?>

                <?php if (isset($_GET['success'])): ?>
                    <div class="p-4 rounded-2xl bg-green-50 border border-green-100 text-green-600 text-xs font-bold text-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Diwaangalinta waa lagu guulaystay! Hadda soo logow.
                    </div>
                <?php
endif; ?>

                <button type="submit" class="w-full py-5 btn-gradient text-white rounded-[2rem] font-black uppercase tracking-[0.2em] text-xs shadow-xl shadow-blue-500/20 hover:shadow-blue-500/40 transition-all">
                    Login / Soo Gal
                </button>
            </form>

            <div class="mt-10 text-center">
                <p class="text-slate-400 font-bold text-[11px] uppercase tracking-widest mb-4">Account ma leedahay?</p>
                <a href="register.php" class="inline-flex items-center gap-2 text-blue-600 font-black text-xs uppercase tracking-widest hover:underline">
                    Diiwaangali Halkan <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">&copy; <?php echo date('Y'); ?> CIILTIRE STORE</p>
        </div>
    </div>

</body>
</html>
