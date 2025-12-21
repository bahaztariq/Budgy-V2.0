<?php
require('../Cards/show-cards.php');


// if (!isset($_SESSION['user_id'])) {   
//       header("Location: ../auth/login.php");    
//       exit;
// }
// ?>
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
                    <i class="w-5 h-5 ph ph-chart-line-down text-xl "></i>
                    <span class="font-medium">Expences</span>
                </a>
                <a href="Cards.php" class="flex items-center gap-3 px-4 py-3 bg-[#70E000] text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 fa-regular fa-credit-card"></i>
                    <span class="font-medium">Cards</span>
                </a>
                <a href="Transactions.php" class="flex items-center gap-3 px-4 py-3  text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
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
                    <button class="Add-Card-btn bg-black py-2 px-4 rounded-2xl text-white cursor-pointer">+ Add New Card</button>
                   </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mb-8">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $expiryDate = ($row['expiryDate'] != '0000-00-00 00:00:00') 
                ? date("m/y", strtotime($row['expiryDate'])) : "**/**"; 
            
            $displayNumber = $row['cardNumber'];
            $isActive = $row['isActive'];
            $opacityClass = ($isActive == 0) ? 'opacity-60 grayscale' : '';
    ?>
            
            <div class="flex flex-col items-center shadow-md bg-gray-300 p-4 rounded-xl">
                
                <div id="card-container-<?php echo $row['id'];?>" class=" relative w-96 h-56 bg-[#70E000] rounded-2xl shadow-2xl overflow-hidden text-white font-mono transition-all duration-300 hover:scale-105 <?php echo $opacityClass; ?>"> 
                    <div class="relative w-full h-full p-6 flex flex-col justify-between z-10">
                        <div class="flex justify-between items-start">
                            <div class="text-sm font-bold tracking-widest uppercase text-black">
                                <?php echo htmlspecialchars($row['BankName']); ?>
                            </div>
                            <div class="text-xl font-bold italic text-black">
                                <?php echo strtoupper($row['cardType']); ?>
                            </div>
                        </div>

                        <div class="w-12 h-9 bg-gradient-to-br from-yellow-200 to-yellow-500 rounded-md border border-yellow-600 shadow-inner flex items-center justify-center relative overflow-hidden">
                            <div class="w-full h-[1px] bg-yellow-700 absolute top-1/3"></div>
                            <div class="w-full h-[1px] bg-yellow-700 absolute bottom-1/3"></div>
                            <div class="h-full w-[1px] bg-yellow-700 absolute left-1/3"></div>
                            <div class="h-full w-[1px] bg-yellow-700 absolute right-1/3"></div>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-2xl font-bold tracking-widest drop-shadow-md text-black">
                                <?php echo htmlspecialchars($displayNumber); ?>
                            </h3>
                        </div>

                        <div class="flex justify-between items-end mt-2">
                            <div class="flex flex-col space-y-1">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <p class="text-[10px] text-gray-700 uppercase">Card Holder</p>
                                        <p class="font-bold tracking-wide uppercase text-sm text-black">
                                            <?php echo htmlspecialchars($row['CardHolder']); ?>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-700 uppercase">Expires</p>
                                        <p class="font-bold tracking-wide text-sm text-black">
                                            <?php echo $expiryDate; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-96 mt-4 px-4  flex justify-between items-center">
                    
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-semibold">Current Balance</p>
                        <p class="text-xl font-bold text-slate-800 ">
                            $<?php echo number_format($row['balance'], 2); ?>
                        </p>
                    </div>

                    <div class="flex items-center">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" <?php echo ($isActive == 1) ? 'checked' : ''; ?> onchange="toggleStatus(<?php echo $row['id']; ?>, this)">
                            
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            
                            <span class="ms-3 text-sm font-medium text-gray-900 " id="status-text-<?php echo $row['id'];?>" >
                                <?php echo ($isActive == 1) ? 'Active' : 'inActive'; ?>
                            </span>
                        </label>
                    </div>

                </div>
            </div>
    <?php 
        } 
    } else {
        echo '<div class="text-slate-500 col-span-3 text-center p-10">No cards found.</div>';
    }
    ?>
</div>
    </main>
<div class="modal Add-card-form w-full h-screen bg-black/30 fixed top-0 left-0 flex justify-center items-center z-50 p-4 hidden">
    <div class="relative w-full md:w-3/4 flex justify-center items-center gap-4 md:gap-16 bg-white rounded-xl flex-col md:flex-row p-4">
        <button class="close-Modal-btn absolute top-2 right-4 text-3xl cursor-pointer z-50">&times;</button>
        
        <div class="relative w-96 h-56 bg-[#70E000] rounded-2xl shadow-2xl overflow-hidden text-white font-mono transition-all duration-300 hover:scale-105"> 
            <div class="relative w-full h-full p-6 flex flex-col justify-between z-10">
                <div class="flex justify-between items-start">
                    <div id="display-bank" class="bank-name text-sm font-bold tracking-widest uppercase text-black">
                        CIH
                    </div>
                    <div id="display-type" class="card-type text-xl font-bold italic text-black">
                        Visa
                    </div>
                </div>

                <div class="w-12 h-9 bg-gradient-to-br from-yellow-200 to-yellow-500 rounded-md border border-yellow-600 shadow-inner flex items-center justify-center relative overflow-hidden">
                    <div class="w-full h-[1px] bg-yellow-700 absolute top-1/3"></div>
                    <div class="w-full h-[1px] bg-yellow-700 absolute bottom-1/3"></div>
                    <div class="h-full w-[1px] bg-yellow-700 absolute left-1/3"></div>
                    <div class="h-full w-[1px] bg-yellow-700 absolute right-1/3"></div>
                </div>

                <div class="mt-4">
                    <h3 id="display-number" class="card-Number text-2xl font-bold tracking-widest drop-shadow-md text-black">
                        0000 0000 0000 0000
                    </h3>
                </div>

                <div class="flex justify-between items-end mt-2">
                    <div class="flex flex-col space-y-1">
                        <div class="flex items-center space-x-4">
                            <div>
                                <p class="text-[10px] text-gray-700 uppercase">Card Holder</p>
                                <p id="display-holder" class="card-holder font-bold tracking-wide uppercase text-sm text-black">
                                    JOHN DOE
                                </p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-700 uppercase">Expires</p>
                                <p id="display-expiry" class="card-expiry font-bold tracking-wide text-sm text-black">
                                    MM/YY
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="../Cards/add-card.php" method="POST" class="relative w-full max-w-116 rounded-xl px-4 py-8 flex flex-col items-center gap-2 overflow-y-auto">
            
            <h2 class="font-bold text-3xl text-black">Add Card</h2>
            
            <div class="flex flex-col w-full gap-1">
                <label for="input-type">Card Type:</label>
                <select name="cardType" id="input-type" class="w-full p-2 bg-gray-200 rounded border border-gray-300">
                    <option value="Visa">Visa</option>
                    <option value="Master Card">Master Card</option>
                    <option value="Union Pay">Union Pay</option>
                </select>
            </div>

            <div class="flex flex-col w-full gap-1">
                <label for="input-bank">Bank:</label>
                <select name="bankname" id="input-bank" class="w-full p-2 bg-gray-200 rounded border border-gray-300">
                    <option value="Cih">Cih</option>
                    <option value="BMCE">BMCE</option>
                    <option value="Populaire">Populaire Bank</option>
                    <option value="WafaCash">Wafacash</option>
                    <option value="BankaLik">BankaLik</option>
                    <option value="Western Union">Western Union</option>
                </select>
            </div>

            <div class="flex flex-col w-full gap-1">
                <label for="input-holder">Holder:</label>
                <input type="text" name="cardHolder" id="input-holder" placeholder="John Doe" class="p-2 bg-gray-200 rounded border border-gray-300" required>
            </div>

            <div class="flex flex-col w-full gap-1">
                <label for="input-balance">Balance:</label>
                <input type="text" name="balance" id="input-balance" placeholder="1000.00" class="p-2 bg-gray-200 rounded border border-gray-300" required>
            </div>

            <div class="flex flex-col w-full gap-1">
                <label for="input-number">Card Number:</label>
                <input type="text" name="cardNumber" id="input-number" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" class="p-2 bg-gray-200 rounded border border-gray-300" required>
            </div>

            <div class="flex w-full gap-4">
                <div class="flex flex-col w-full gap-1">
                    <label for="input-expiry">Expiry Date:</label>
                    <input type="text" name="expiryDate" id="input-expiry" maxlength="5" placeholder="MM/YY" class="p-2 bg-gray-200 rounded border border-gray-300" required>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="input-cvv">CVV:</label>
                    <input type="text" maxlength='3' name="cardCvv" id="input-cvv" placeholder="123" class="p-2 bg-gray-200 rounded border border-gray-300" required>
                </div>
            </div>

            <input type="submit" value="Add Card" class="w-full bg-black text-white rounded-xl p-4 mt-4 cursor-pointer hover:bg-gray-800">
        </form>
    </div>
</div>
</body>
</html>
   <script src="../js/script.js"></script>
</body>
</html>