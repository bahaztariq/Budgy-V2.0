<?php
require('../Cards/show-cards.php');


if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}
$userid = $_SESSION['user_id'];


$sql = "select * from category_limits";
$categorie = mysqli_query($connect, $sql);


$sql2 = "select * from Recurring_transactions where UserID = '$userid' ";
$result2 = mysqli_query($connect, $sql2);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-incomes</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="icon" href="../imgs/icon.png">
</head>
<body class="flex">
    <aside class="h-screen flex flex-col absolute z-40 left-0 top-0 bottom-0 w-64 bg-black text-white transition-transform duration-300 ease-in-out md:relative md:tranblack-x-0 hidden lg:block">
            
            <div class="h-16 flex items-center px-4  border-black-700">
                <img src="../imgs/icon.png" alt="" class="w-12 h-12">
                <h1 class="text-xl font-bold tracking-wider">Budgy<span class="text-[#70E000]">BOARD</span></h1>
            </div>

            <nav class="flex-1 h-full px-2 py-4 space-y-2 overflow-y-auto">
                <a href="Dashboard.php" class="flex items-center gap-3 px-4 py-3  rounded-lg text-white">
                    <i class="w-5 h-5 ph ph-squares-four text-xl"></i>
                    <span class="font-medium">Overview</span>
                </a>
                <a href="incomes.php" class="flex items-center gap-3 px-4 py-3 text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 ph ph-chart-line-up text-xl"></i>
                    <span class="font-medium">Incomes</span>
                </a>
                <a href="expences.php" class="flex items-center gap-3 px-4 py-3  text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 ph ph-chart-line-down text-xl"></i>
                    <span class="font-medium">Expences</span>
                </a>
                <a href="Cards.php" class="flex items-center gap-3 px-4 py-3  text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 fa-regular fa-credit-card"></i>
                    <span class="font-medium">Cards</span>
                </a>
                <a href="Transactions.php" class="flex items-center gap-3 px-4 py-3  text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 fa-solid fa-receipt"></i>
                    <span class="font-medium"> Transactions</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-[#70E000] text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 fa-regular fa-clock"></i>
                    <span class="font-medium">Reccuring Trx</span>
                </a>
                <a href="logout.php" class="self-end flex items-center gap-3 px-4 py-3  rounded-lg text-white">
                     <i class="w-5 h-5 fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="font-medium">Logout</span>
                </a>
            </nav>
        </aside>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-black-50 p-6">
                
                <div class="mb-6 flex w-full justify-between">
                    <div>
                    <h2 class="text-2xl font-bold text-black-800">Dashboard Overview</h2>
                    <p class="text-sm text-black-500">Welcome back, here's what's happening today.</p>
                    </div>
                    <div>
                    <button class="Add-Reccuring-btn bg-black py-2 px-4 rounded-2xl text-white cursor-pointer">+ Schedule Transaction</button>
                   </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4  flex justify-between items-center bg-[#70E000]">
                        <h3 class="font-bold text-lg text-black-800">Transactions</h3>
                       
                    </div>
                    <table class="w-full text-left text-sm text-black-600">
                            <thead class="bg-black-50 text-xs uppercase font-semibold text-black-500 bg-[#70E000] ">
                                <tr>
                                    <th class="px-6 py-4">Transaction ID</th>
                                    <th class="px-6 py-4">Amount</th>
                                    <th class="px-6 py-4">card Number</th>
                                    <th class="px-6 py-4">Category</th>
                                    <th class="px-6 py-4">repetition</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black-100">
                                <?php
                                while($row = mysqli_fetch_assoc($result2)){
                                  echo "<tr class='hover:bg-black-50 transition odd:bg-gray-300'>
                                   <td class='px-6 py-4 font-medium text-black-800'>#{$row['id']}</td>
                                   <td class='px-6 py-4'>
                                     <div class='flex items-center gap-3'>
                                     <span>{$row['montant']}</span>DH
                                        
                                     </div>
                                   </td>
                                   <td class='px-6 py-4'><span>{$row['cardNumber']}</span></td>
                                   <td class='px-6 py-4'><span>{$row['category']}</span></td>
                                    <td class='px-6 py-4'><span>{$row['repititon']}</span></td>
                                 </tr>";
                                }
                                 ?>
                            </tbody>
                        </table>
                </div>
    </main>
    <div class="modal Add-Reccuring-form w-full h-screen bg-black/30 fixed top-0 left-0 flex justify-center items-center z-50 p-4 " >
            
            <form action="../Cards/schedule-transaction.php" method="POST" class=" relative w-full max-w-116 bg-white   rounded-xl px-4 py-8 flex flex-col items-center gap-2 overflow-y-auto ">
                <button class="close-Modal-btn absolute top-2 right-4 text-3xl cursor-pointer z-50">&times;</button>
                <h2 class="font-bold text-3xl text-black">Schedule Transactions</h2>
                <div class="flex flex-col w-full gap-1">
                       <label for="cardSelect">Choose card:</label>
                            <select name="Card" id="cardSelect" class="w-full p-2 bg-gray-200 rounded border border-gray-300">
                                <option value="0" data-balance ="0">-- Card Choose --</option>
                                    <?php
                                     while ($row = $result->fetch_assoc()) {
                                         $balanceDisplay = number_format($row['balance'], 2);
                                    ?>
                                        <option 
                                             value="<?php echo htmlspecialchars($row['cardNumber']); ?>" 
                                             data-balance="<?php echo htmlspecialchars($row['balance']); ?>"> 
                                            <?php echo htmlspecialchars($row['cardNumber']) . " (Balance: $" . $balanceDisplay . ")"; ?> 
                                        </option>
                                    <?php
                                    }
                                    ?>
                            </select>
                </div>
                <div class="flex flex-col w-full gap-1">
                <label for="">category:</label>
                <select name="category" id="category" class="w-full p-2 bg-gray-200 rounded border border-gray-300">
                 <option value="0" >--choose category --</option>
                 <?php
                 while($row = mysqli_fetch_assoc($categorie)){
                 ?>
                 <option value="<?php echo htmlspecialchars($row['category']); ?>" data-limit="<?php echo htmlspecialchars($row['limit_amount']); ?>" >
                    <?php echo htmlspecialchars($row['category']); ?>
                </option>
                 <?php
                 }
                 ?>
                </select>  
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="amountInput">Amount:</label>
                    <input 
                        type="number" 
                        step="1.00" 
                        name="montant" 
                        id="amountInput" 
                        placeholder="0.00" 
                        class="p-2 bg-gray-200 rounded border border-gray-300" 
                        required>
                    <span id="balanceMsg" class="text-xs text-gray-500"></span>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="">repetition</label>
                    <select name="repititon" id="repititon" class="w-full p-2 bg-gray-200 rounded border border-gray-300">
                        <option value="0" >--choose repetition --</option>
                        <option value="daily">daily</option>
                        <option value="weekly">weekly</option>
                        <option value="monthly">monthly</option>
                    </select>
                </div>
               <input type="submit" value="Schedule Transaction" class=" w-full bg-black text-white rounded-xl p-4">
            </form>
        
    </div>
   <script src="../js/script.js"></script>
</body>
</html>