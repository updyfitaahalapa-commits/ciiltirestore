<?php
require_once 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$conn = getDBConnection();

// Fetch Summary Stats
$stats = [
    'total_orders' => 0,
    'total_revenue' => 0,
    'pending_orders' => 0,
    'completed_orders' => 0
];

$stats_query = "SELECT 
    COUNT(*) as total_orders, 
    SUM(CASE WHEN status = 'completed' THEN price ELSE 0 END) as total_revenue,
    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_orders,
    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_orders
FROM orders";

if ($result = $conn->query($stats_query)) {
    $stats = $result->fetch_assoc();
}

// Fetch Orders
$status_filter = isset($_GET['status']) ? $conn->real_escape_string($_GET['status']) : '';
$where_clause = $status_filter ? "WHERE status = '$status_filter'" : "";
$orders_query = "SELECT * FROM orders $where_clause ORDER BY order_date DESC LIMIT 50";
$orders_result = $conn->query($orders_query);

?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CIILTIRE STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f1f5f9; }
        .glass-sidebar { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-right: 1px solid rgba(255, 255, 255, 0.5); }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .btn-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); }
        .status-badge { @apply px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest; }
        .status-pending { @apply bg-amber-50 text-amber-600 border border-amber-100; }
        .status-completed { @apply bg-green-50 text-green-600 border border-green-100; }
        .status-failed { @apply bg-red-50 text-red-600 border border-red-100; }
        .status-processing { @apply bg-blue-50 text-blue-600 border border-blue-100; }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 w-72 glass-sidebar z-50 hidden lg:flex flex-col p-8">
        <div class="flex items-center gap-3 mb-12">
            <div class="w-10 h-10 btn-gradient rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-user-shield text-white text-lg"></i>
            </div>
            <div>
                <span class="text-xl font-black tracking-tight text-slate-900 block leading-none">CIILTIRE</span>
                <span class="text-[10px] font-bold tracking-[0.2em] text-blue-600 uppercase italic">Admin</span>
            </div>
        </div>

        <nav class="space-y-2 flex-grow">
            <a href="admin_dashboard.php" class="flex items-center gap-3 px-5 py-4 rounded-2xl bg-blue-50 text-blue-600 font-bold text-sm transition-all border border-blue-100/50">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="admin_dashboard.php?status=pending" class="flex items-center gap-3 px-5 py-4 rounded-2xl hover:bg-slate-50 text-slate-500 hover:text-slate-900 font-bold text-sm transition-all group">
                <i class="fas fa-clock group-hover:text-amber-500"></i> Pending Orders
            </a>
            <a href="admin_dashboard.php?status=completed" class="flex items-center gap-3 px-5 py-4 rounded-2xl hover:bg-slate-50 text-slate-500 hover:text-slate-900 font-bold text-sm transition-all group">
                <i class="fas fa-check-circle group-hover:text-green-500"></i> Completed
            </a>
            <a href="index.php" class="flex items-center gap-3 px-5 py-4 rounded-2xl hover:bg-slate-50 text-slate-500 hover:text-slate-900 font-bold text-sm transition-all">
                <i class="fas fa-external-link-alt"></i> View Site
            </a>
        </nav>

        <div class="pt-8 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-6 p-2 rounded-2xl bg-slate-50">
                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 font-black">
                    <?php echo strtoupper(substr($_SESSION['admin_username'], 0, 1)); ?>
                </div>
                <div>
                    <span class="block text-xs font-black text-slate-900"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    <span class="block text-[10px] font-bold text-slate-400 italic uppercase"><?php echo htmlspecialchars($_SESSION['admin_role']); ?></span>
                </div>
            </div>
            <a href="logout.php" class="flex items-center gap-3 px-5 py-4 rounded-2xl hover:bg-red-50 text-red-500 font-bold text-sm transition-all">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow lg:ml-72 p-6 md:p-12 pb-24">
        
        <!-- Header -->
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-black text-slate-900 italic uppercase tracking-tight mb-2">Maamulka Dalabyada</h1>
                <p class="text-slate-500 font-medium">Kala soco, maamul, oo u fuli dalabyada macaamiisha si deg deg ah.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="px-6 py-3 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Time</span>
                    <span class="text-sm font-black text-slate-900"><?php echo date('H:i'); ?></span>
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="glass-card rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-all border-b-4 border-b-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest bg-blue-50/50 px-2 py-1 rounded-lg">Total</span>
                </div>
                <span class="block text-4xl font-black text-slate-900 tracking-tighter mb-1"><?php echo $stats['total_orders']; ?></span>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Dalabyo Guud</span>
            </div>

            <div class="glass-card rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-all border-b-4 border-b-amber-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-clock"></i>
                    </div>
                    <span class="text-[10px] font-black text-amber-500 uppercase tracking-widest bg-amber-50/50 px-2 py-1 rounded-lg">Pending</span>
                </div>
                <span class="block text-4xl font-black text-slate-900 tracking-tighter mb-1"><?php echo $stats['pending_orders']; ?></span>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Ina Sugaysa</span>
            </div>

            <div class="glass-card rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-all border-b-4 border-b-green-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <span class="text-[10px] font-black text-green-500 uppercase tracking-widest bg-green-50/50 px-2 py-1 rounded-lg">Revenue</span>
                </div>
                <span class="block text-4xl font-black text-slate-900 tracking-tighter mb-1">$<?php echo number_format($stats['total_revenue'], 2); ?></span>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Lacagta Guud</span>
            </div>

            <div class="glass-card rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-all border-b-4 border-b-slate-900">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 px-2 py-1 rounded-lg">Users</span>
                </div>
                <span class="block text-4xl font-black text-slate-900 tracking-tighter mb-1">
                    <?php 
                        $u_res = $conn->query("SELECT COUNT(*) as c FROM users");
                        echo $u_res->fetch_assoc()['c'];
                    ?>
                </span>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Macaamiisha</span>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-sm">
            <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-xl font-black text-slate-900 uppercase italic tracking-tight">Dalabyadii u dambeeyay</h3>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-200 transition-all">Export</button>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                            <th class="px-8 py-6">Order ID</th>
                            <th class="px-8 py-6">Player ID & Game</th>
                            <th class="px-8 py-6">Package</th>
                            <th class="px-8 py-6">Payment</th>
                            <th class="px-8 py-6">Status</th>
                            <th class="px-8 py-6">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if ($orders_result->num_rows > 0): ?>
                            <?php while($order = $orders_result->fetch_assoc()): ?>
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-6">
                                        <span class="block text-sm font-black text-slate-900">#<?php echo $order['order_id']; ?></span>
                                        <span class="block text-[10px] font-bold text-slate-400 uppercase italic"><?php echo date('M d, H:i', strtotime($order['order_date'])); ?></span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                                                <i class="fas fa-gamepad"></i>
                                            </div>
                                            <div>
                                                <span class="block text-sm font-black text-slate-900"><?php echo htmlspecialchars($order['player_id']); ?></span>
                                                <span class="block text-[11px] font-semibold text-slate-500"><?php echo htmlspecialchars($order['game_name']); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="px-3 py-1 bg-slate-100 rounded-lg text-xs font-black text-slate-700"><?php echo number_format($order['package_uc']); ?> UC</span>
                                        <span class="block text-[11px] font-bold text-blue-500 mt-1">$<?php echo number_format($order['price'], 2); ?></span>
                                    </td>
                                    <td class="px-8 py-6 text-sm">
                                        <span class="block font-black text-slate-700 italic"><?php echo htmlspecialchars($order['payment_method']); ?></span>
                                        <span class="block text-[10px] font-bold text-slate-400"><?php echo htmlspecialchars($order['payment_number']); ?></span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="status-badge status-<?php echo $order['status']; ?>">
                                            <?php echo $order['status']; ?>
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <form action="admin_update_order.php" method="POST" class="flex gap-2">
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                            <?php if($order['status'] == 'pending' || $order['status'] == 'processing'): ?>
                                                <button name="status" value="completed" class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all shadow-sm" title="Mark as Completed">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button name="status" value="failed" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Cancel/Failed">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            <?php else: ?>
                                                <span class="text-[10px] font-bold text-slate-300 uppercase italic">No Action</span>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center">
                                    <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Wax dalab ah weli lama helin</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>
</html>
<?php $conn->close(); ?>
