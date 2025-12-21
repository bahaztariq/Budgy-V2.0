<?php
include('../incomes/show-incomes.php');



if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$income_data = null;
if(isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($connect, $_GET['edit_id']);
    $query = "SELECT * FROM incomes WHERE id = '$edit_id'";
    $result = mysqli_query($connect, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $income_data = mysqli_fetch_assoc($result);
    }
}
$userid = $_SESSION['user_id'];

$stmt = $connect->prepare("SELECT * FROM cards WHERE Userid = ?");
$stmt->bind_param("i", $userid); 
$stmt->execute();
$cards = $stmt->get_result();
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
                <a href="incomes.php" class="flex items-center gap-3 px-4 py-3 bg-[#70E000] text-black-400 hover:text-white hover:bg-black-800 rounded-lg transition-colors">
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
                    <button class="Add-revenu-btn bg-black py-2 px-4 rounded-2xl text-white cursor-pointer">+ Add Revenu</button>
                   </div>
                </div>
                 <!-- incomes -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border- border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-lg text-black-800">Revenu Transactions</h3>
                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-black-600">
                            <thead class="bg-black-50 text-xs uppercase font-semibold text-black-500">
                                <tr>
                                    <th class="px-6 py-4">Transaction ID</th>
                                    <th class="px-6 py-4">Amount</th>
                                    <th class="px-6 py-4">card Number</th>
                                    <th class="px-6 py-4">Description</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black-100">
                                <?php
                                while($row = mysqli_fetch_assoc($incomes)){
                                  echo "<tr class='hover:bg-black-50 transition'>
                                   <td class='px-6 py-4 font-medium text-black-800'>#{$row['id']}</td>
                                   <td class='px-6 py-4'>
                                     <div class='flex items-center gap-3'>
                                        <span>{$row['montant']}dh</span>
                                     </div>
                                   </td>
                                   <td class='amount px-6 py-4 font-medium text-black-800'><span>{$row['cardNumber']}</span></td>
                                   <td class='px-6 py-4'>{$row['description']}</td>
                                    <td class='px-6 py-4'><span>{$row['date_']}</span></td>
                                   <td class='px-6 py-4'>
                                   <div class='flex gap-4' >
                                    <a href='incomes.php?edit_id={$row['id']}' class='text-blue-400 cursor-pointer'>
                                    <button class='btn-action btn-edit text-blue-400 cursor-pointer'><i class='fas fa-edit'></i></button>
                                  </a>
                                   <a href='incomes/Delete-income.php/?id={$row['id']}' class='text-red-400 cursor-pointer' >
                                    <button class='btn-action btn-delete text-red-400 cursor-pointer'><i class='fas fa-trash'></i></button>
                                  </a>   
                                  </div>
                                 </td>
                                 </tr>";
                                }
                                 ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="h-10"></div>
    </main>
    <div class="modal Add-revenu-form w-full h-screen bg-black/30 fixed top-0 left-0 flex justify-center items-center hidden" >
        <form action="../incomes/add-income.php" method="POST" class=" relative w-full max-w-116 max-h-80 md:max-h-128 bg-white rounded-xl shadow-md px-4 py-8 flex flex-col items-center gap-4 overflow-y-auto ">
            <button class="close-Modal-btn absolute top-2 right-4 text-3xl cursor-pointer">&times;</button>
            <h2 class="font-bold text-3xl text-black">Add Revenu</h2>
            <div class="flex flex-col w-full gap-1">
                       <label for="cardSelect">Choose card:</label>
                            <select name="Card" id="cardSelect" class="w-full p-2 bg-gray-200 rounded border border-gray-300">
                                <option value="0" data-balance ="0">--No Card Choosen --</option>
                                    <?php
                                     while ($row = $cards->fetch_assoc()) {
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
                <label for="">Montant:</label>
                <input type="text" name="montant" pattern ="[0-9]*" placeholder="Enter the amount of Revenu" class=" p-2 bg-gray-200 rounded border border-gray-300" required>
            </div>
            <div class="flex flex-col w-full gap-1">
                <label for="">Date:</label>
                <input type="date" name="Date"  placeholder="Enter the amount of Revenu" class=" p-2 bg-gray-200 rounded border border-gray-300" required>
            </div>
            <div class="flex flex-col w-full gap-1">
                <label for="">Description:</label>
                <textarea name="description" id="" placeholder="Enter the Description of Revenu" class=" min-h-30 p-2 bg-gray-200 rounded border border-gray-300" required></textarea>
            </div>

            <input type="submit" value="Add Revenu" class=" w-full bg-black text-white rounded-xl p-4">
        </form>
    </div>
    <div class="modal Modify-revenu-form w-full h-screen bg-black/30 fixed top-0 left-0 flex justify-center items-center <?php echo isset($_GET['edit_id']) ? '' : 'hidden'; ?>" >
        <form action="incomes/modify-income.php" method="POST" class="relative w-full max-w-116 max-h-80 md:max-h-128 bg-white rounded-xl shadow-md px-4 py-8 flex flex-col items-center gap-4 overflow-y-auto">
            <button type="button" onclick="window.location.href='incomes.php'" class="close-Modal-btn absolute top-2 right-4 text-3xl cursor-pointer">&times;</button>
            <h2 class="font-bold text-3xl text-black">Modify Revenu</h2>
            
            <input type="hidden" name="id" value="<?php echo $income_data ? $income_data['id'] : ''; ?>">
            
            <div class="flex flex-col w-full gap-1">
                <label for="">Montant:</label>
                <input type="text" name="montant" pattern="[0-9]{1,}" value="<?php echo $income_data ? htmlspecialchars($income_data['montant']) : ''; ?>" placeholder="Enter the amount of Revenu" class="p-2 bg-gray-200 rounded border border-gray-300" required>
            </div>
            <div class="flex flex-col w-full gap-1">
                <label for="">Date:</label>
                <input type="date" name="Date" value="<?php echo $income_data ? htmlspecialchars($income_data['date_']) : ''; ?>" class="p-2 bg-gray-200 rounded border border-gray-300" required>
            </div>
            <div class="flex flex-col w-full gap-1">
                <label for="">Description:</label>
                <textarea name="description" placeholder="Enter the Description of Revenu" class="min-h-30 p-2 bg-gray-200 rounded border border-gray-300" required><?php echo $income_data ? htmlspecialchars($income_data['description']) : ''; ?></textarea>
            </div>
            <input type="submit" value="Update Revenu" class="w-full bg-black text-white rounded-xl p-4 cursor-pointer">
        </form>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>