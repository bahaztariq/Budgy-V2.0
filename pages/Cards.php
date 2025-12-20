<?php
require('../db/db_connect.php');


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
                <a href="Bills.php" class="flex items-center gap-3 px-4 py-3 text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
                    <i class="w-5 h-5 fa-solid fa-receipt"></i>
                    <span class="font-medium"> bills</span>
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
    </main>
    <div class="modal Add-card-form w-full h-screen bg-black/30 fixed top-0 left-0 flex justify-center items-center z-50 p-4 hidden" >
        <div class=" relative w-full md:w-3/4 flex justify-center items-center gap-4 md:gap-16 bg-white rounded-xl flex-col md:flex-row p-4">
            <button class="close-Modal-btn absolute top-2 right-4 text-3xl cursor-pointer z-50">&times;</button>
            <div class="w-full md:w-1/2 h-full card-container flex justify-center items-center ">
               <div class="bg-black/20 rounded-2xl w-96 h-54">
                <p>number</p>
               </div>
            </div>

            <form action="../Cards/add-card.php" method="POST" class=" relative w-full max-w-116   rounded-xl px-4 py-8 flex flex-col items-center gap-2 overflow-y-auto ">
              
                <h2 class="font-bold text-3xl text-black">Add Card</h2>
                <div class="flex flex-col w-full gap-1">
                    <label for="">Card Type:</label>
                    <select name="cardType" id="" class="w-full  p-2 bg-gray-200 rounded border border-gray-300">
                        <option value="Visa">Visa</option>
                        <option value="Master Card">Master Card</option>
                        <option value="union">union</option>
                    </select>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="">Bank:</label>
                    <select name="bankname" id="" class="w-full  p-2 bg-gray-200 rounded border border-gray-300">
                        <option value="Cih">Cih</option>
                        <option value="BMCE">BMCE</option>
                        <option value="Populaire">puplaire bank</option>
                        <option value="wafaCash">wafacash</option>
                        <option value="bankaLik">bankalik</option>
                        <option value="western Union">western union</option>
                    </select>
                </div>
                <div class="flex flex-col w-full gap-1">
                  <label for="">Holder:</label>
                  <input type="text" name="cardHolder" id="cardHolder"  placeholder="john doe" class=" p-2 bg-gray-200 rounded border border-gray-300" required>
                </div>
                <div class="flex flex-col w-full gap-1">
                  <label for="">Balance:</label>
                  <input type="text" name="balance" id="cardHolder"  placeholder="john doe" class=" p-2 bg-gray-200 rounded border border-gray-300" required>
                </div>
                <div class="flex flex-col w-full gap-1">
                  <label for="">Card Number:</label>
                  <input type="text" name="cardNumber" id="cardNumber" pattern ="[0-9\s]*" placeholder="XXXX XXXX XXXX XXXX" class=" p-2 bg-gray-200 rounded border border-gray-300" required>
                </div>
                <div class="flex w-full gap-4">
                 <div class="flex flex-col w-full gap-1">
                   <label for="">expiry date:</label>
                   <input type="text" name="expiryDate" pattern="[0-9]{2}/[0-9]{2}"  placeholder="01/01" class=" p-2 bg-gray-200 rounded border border-gray-300" required>
                 </div>
                 <div class="flex flex-col w-full gap-1">
                   <label for="">Cvv:</label>
                   <input type="text"  maxlength='3' name="cardCvv" id="" placeholder="000" class=" p-2 bg-gray-200 rounded border border-gray-300" required>
                  </div>
                </div>
             <input type="submit" value="Add Card" class=" w-full bg-black text-white rounded-xl p-4">
            </form>
        </div>
    </div>
   <script src="../js/script.js"></script>
</body>
</html>