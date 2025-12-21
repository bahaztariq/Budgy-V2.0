<?php
require('../db/db_connect.php');

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Dashboard Template</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sekuya&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="icon" href="../imgs/icon.png">

    <style>
        /* Custom Scrollbar for cleaner look */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-black-50 text-black-800" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <aside class="h-screen flex flex-col absolute z-40 left-0 top-0 bottom-0 w-64 bg-black text-white transition-transform duration-300 ease-in-out md:relative md:tranblack-x-0 hidden lg:block">
            
            <div class="h-16 flex items-center px-4  border-black-700">
                <img src="../imgs/icon.png" alt="" class="w-12 h-12">
                <h1 class="text-xl font-bold tracking-wider">Budgy<span class="text-[#70E000]">BOARD</span></h1>
            </div>

            <nav class="flex-1 h-full px-2 py-4 space-y-2 overflow-y-auto">
                <a href="Dashboard.php" class="flex items-center gap-3 px-4 py-3 bg-[#70E000] rounded-lg text-white">
                    <i class="w-5 h-5 ph ph-squares-four text-xl"></i>
                    <span class="font-medium">Overview</span>
                </a>
                <a href="incomes.php" class="flex items-center gap-3 px-4 py-3 text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 ph ph-chart-line-up text-xl"></i>
                    <span class="font-medium">Incomes</span>
                </a>
                <a href="expences.php" class="flex items-center gap-3 px-4 py-3 text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 ph ph-chart-line-down text-xl"></i>
                    <span class="font-medium">Expences</span>
                </a>
                <a href="Cards.php" class="flex items-center gap-3 px-4 py-3 text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 fa-regular fa-credit-card"></i>
                    <span class="font-medium">Cards</span>
                </a>
                <a href="Transactions.php" class="flex items-center gap-3 px-4 py-3 text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 fa-solid fa-receipt"></i>
                    <span class="font-medium"> Transactions</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 ph ph-gear text-xl"></i>
                    <span class="font-medium">Settings</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 fa-solid fa-download"></i>
                    <span class="font-medium">download</span>
                </a>
                <a href="../auth/logout.php" class="self-end flex items-center gap-3 px-4 py-3  rounded-lg text-white">
                     <i class="w-5 h-5 fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="font-medium">Logout</span>
                </a>
            </nav>
        </aside>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-30 md:hidden"></div>

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-20">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-black-600 focus:outline-none">
                    <i class="w-5 h-5 ph ph-list text-2xl"></i>
                </button>

                <div class="hidden md:flex items-center bg-black-100 rounded-lg px-3 py-2 w-64">
                    <i class="w-5 h-5 ph ph-magnifying-glass text-black-400 text-lg"></i>
                    <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none text-sm ml-2 w-full placeholder-black-400">
                </div>

                <div class="flex items-center gap-4">
                    <button class="relative p-2 text-black-500 hover:bg-black-100 rounded-full transition">
                        <i class="w-5 h-5 ph ph-bell text-xl"></i>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-black-50 p-6">
                
                <div class="mb-6 flex w-full justify-between">
                    <div>
                    <h2 class="text-2xl font-bold text-black-800">Dashboard Overview</h2>
                    <p class="text-sm text-black-500">Welcome back, here's what's happening today.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                            <p class="text-xs text-black-500 font-medium uppercase">Total Revenue</p>
                            <?php 
                             $sql = "SELECT SUM(montant) AS TotalRevenu FROM incomes WHERE UserID = '$userid' GROUP BY DATE_FORMAT(dateIn,'%Y-%m') ORDER BY DATE_FORMAT(dateIn,'%Y-%m') DESC LIMIT 1";
                             $query = mysqli_query($connect, $sql); 
                             $row1 = mysqli_fetch_assoc($query);
                             $sum1 = $row1['TotalRevenu'] ?? 0; 
                             echo "<h3 class='text-2xl font-bold text-black-800'>" . number_format($sum1, 2) . "</h3>";
                             ?>
                            </div>
                            <div class="p-2 bg-green-50 rounded-lg text-green-600">
                                <i class="w-5 h-5 ph ph-currency-dollar text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-xs text-green-600 flex items-center gap-1">
                            <i class="w-5 h-5 ph ph-trend-up"></i> +20.1% <span class="text-black-400">from last month</span>
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-xs text-black-500 font-medium uppercase">Total Expences</p>
                                <?php 
                                $sql = "SELECT SUM(montant) AS TotalExpences FROM expences WHERE UserID = '$userid' GROUP BY DATE_FORMAT(dateIn,'%Y-%m') ORDER BY DATE_FORMAT(dateIn,'%Y-%m') DESC LIMIT 1";
                                $query = mysqli_query($connect, $sql); 
                                $row2 = mysqli_fetch_assoc($query);
                                $sum2 = $row2['TotalExpences'] ?? 0; 
                                echo "<h3 class='text-2xl font-bold text-black-800'>" . number_format($sum2, 2) . "</h3>";
                             ?>
                            </div>
                            <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                                <i class="w-5 h-5 ph ph-users-three text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-xs text-green-600 flex items-center gap-1">
                            <i class="w-5 h-5 ph ph-trend-up"></i> +5.4% <span class="text-black-400">from last month</span>
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-xs text-black-500 font-medium uppercase">Balance</p>
                                <?php 
                             $sum = $sum1  - $sum2 ; 
                             echo "<h3 class='text-2xl font-bold text-black-800'>" . number_format($sum, 2) . "</h3>";
                             ?>
                            </div>
                            <div class="p-2 bg-red-50 rounded-lg text-red-600">
                                <i class="w-5 h-5 ph ph-warning-circle text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-xs text-black-400">Requires attention</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="font-bold text-lg text-black-800 mb-4">Revenue Analytics</h3>
                        <div class="h-64 w-full bg-black-50 rounded-lg flex items-center justify-center  text-black-400">
                         <canvas id="LineChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="font-bold text-lg text-black-800 mb-4">Traffic Source</h3>
                        <div class="h-64 w-full bg-black-50 rounded-lg flex items-center justify-center  text-black-400 mb-4">
                            <canvas id="DonutChart"></canvas>
                        </div>
                        <!-- <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-black-500">Direct</span>
                                <span class="font-bold">54%</span>
                            </div>
                            <div class="w-full bg-black-100 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: 54%"></div>
                            </div>
                            
                            <div class="flex justify-between text-sm">
                                <span class="text-black-500">Referral</span>
                                <span class="font-bold">32%</span>
                            </div>
                            <div class="w-full bg-black-100 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 32%"></div>
                            </div>
                        </div> -->
                    </div>
                </div>


            </main>
        </div>
    </div>
    <script>
        let Donut = [];
        Donut.push("<?php echo $sum1?>");
        Donut.push("<?php echo $sum2?>");
        Donut.push("<?php echo $sum?>");
    </script>
    <script src="../js/script.js"></script>
</body>
</html>