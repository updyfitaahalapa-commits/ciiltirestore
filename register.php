<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diiwaangalin - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex py-10 px-6 relative overflow-x-hidden">
    
    <!-- Animated Background Elements -->
    <div class="fixed top-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-100 rounded-full blur-[120px] opacity-50 pointer-events-none"></div>
    <div class="fixed bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-sky-100 rounded-full blur-[120px] opacity-50 pointer-events-none"></div>

    <div class="w-full max-w-[540px] m-auto relative z-10">
        <div class="glass-card rounded-[40px] shadow-2xl p-8 md:p-12">
            <div class="text-center mb-10">
                <a href="index.php" class="inline-flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 btn-gradient rounded-2xl flex items-center justify-center shadow-lg -rotate-3">
                        <i class="fas fa-gamepad text-white text-xl"></i>
                    </div>
                    <div class="text-left">
                        <span class="text-2xl font-black tracking-tight text-slate-900 block leading-none">CIILTIRE</span>
                        <span class="text-[10px] font-bold tracking-[0.3em] text-blue-600 uppercase italic">Store</span>
                    </div>
                </a>
                <h2 class="text-3xl font-black text-slate-900 mb-2 italic uppercase tracking-tight">Diiwaangalin</h2>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Fadlan buuxi macluumaadkaaga</p>
            </div>

            <form action="auth_process.php" method="POST" class="space-y-6">
                <input type="hidden" name="action" value="register">
                <?php if (isset($_GET['package'])): ?>
                    <input type="hidden" name="package" value="<?php echo htmlspecialchars($_GET['package']); ?>">
                <?php endif; ?>

                <div class="space-y-2">
                    <label for="full_name" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Magaca oo dhameystiran</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-5 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-user-tag text-sm"></i>
                        </div>
                        <input type="text" id="full_name" name="full_name" placeholder="Tusaale: Maxamed Cali" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-2 md:col-span-1">
                        <label for="country_code" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Code</label>
                        <input type="text" id="country_code" name="country_code" value="+252" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none text-center">
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label for="mobile_number" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Mobile Number</label>
                        <input type="tel" id="mobile_number" name="mobile_number" placeholder="61XXXXXXX" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="region" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Magaalaa</label>
                        <input type="text" id="region" name="region" placeholder="Muqdisho" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>
                    <div class="space-y-2">
                        <label for="district" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Degmada</label>
                        <input type="text" id="district" name="district" placeholder="Hodan" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Password</label>
                        <input type="password" id="password" name="password" placeholder="********" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>
                    <div class="space-y-2">
                        <label for="confirm_password" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Hubi Password-ka</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="********" required
                               class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>
                </div>

                <?php if(isset($_GET['error'])): ?>
                    <div class="p-4 rounded-2xl bg-red-50 border border-red-100 text-red-500 text-xs font-bold text-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?php 
                            if($_GET['error'] == 'password_mismatch') echo "Password-lada isku mid maahan!";
                            if($_GET['error'] == 'user_exists') echo "Nambarkan mar hore ayaa la diwaangaliyay!";
                            if($_GET['error'] == 'db_error') echo "Cillad ayaa dhacday, fadlan tijaabi mar kale.";
                        ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="w-full py-5 btn-gradient text-white rounded-[2rem] font-black uppercase tracking-[0.2em] text-xs shadow-xl shadow-blue-500/20 hover:shadow-blue-500/40 transition-all">
                    Register / Diiwaangali
                </button>
            </form>

            <div class="mt-10 text-center">
                <p class="text-slate-400 font-bold text-[11px] uppercase tracking-widest mb-4">Account ma leedahay?</p>
                <a href="login.php" class="inline-flex items-center gap-2 text-blue-600 font-black text-xs uppercase tracking-widest hover:underline">
                    Soo gal halkan <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">&copy; <?php echo date('Y'); ?> CIILTIRE STORE</p>
        </div>
    </div>

</body>
</html>
